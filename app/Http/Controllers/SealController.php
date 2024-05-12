<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Seal;
use App\Models\Package;
use App\Models\Tag;

class SealController extends Controller
{
    /**
     * シール一覧画面、検索
     */
    public function index(Request $request)
    {
        // sealテーブルとpackageテーブルの値(リレーション関数を実行)を取得
        $query = Seal::with(['package', 'tags'])
            // 降順にする
            ->orderBy('id', 'desc');

        // リクエストを取得
        $filters = $request->all();

        // リクエストがあった場合
        if (!empty($filters)) {
            // カテゴリ―検索
            if (!empty($filters['package'])) {
                $query->where('package_id', $filters['package']);
            }
            //  タグ、キーワード検索
            if (!empty($filters['keyword'])) {
                $query->where(function ($query) use ($filters) {
                    $query->where('name', 'LIKE', '%' . $filters['keyword'] . '%')
                        ->orWhereHas('tags', function ($query) use ($filters) {
                            $query->where('name', 'LIKE', '%' . $filters['keyword'] . '%');
                        });
                });
            }
            // お気に入りが0のものだけを検索
            if (!empty($filters['favorite'])) {
                $query->where('favorite', 0);
            }
        }

        $seals = $query->paginate(24);

        // 選択されたパッケージをビューに渡す
        $selectedPackage = isset($filters['package']) ? $filters['package'] : null;
        // 
        $keyword = isset($filters['keyword']) ? $filters['keyword'] : '';

        $packages = Package::all();

        return view('seals.index', compact('seals', 'packages', 'filters', 'selectedPackage', 'keyword'));
    }

    /**
     * 登録画面
     */
    public function create()
    {
        $packages = Package::all();

        return view('seals.create', compact('packages'));
    }

    /**
     * パッケージ登録
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $posts = $request->all();

        Package::insert([
            'user_id' => Auth::id(),
            'name' => $posts['name'],
        ]);

        // フラッシュメッセージ
        flash()->success('パッケージを登録しました。');

        return back();
    }

    /**
     * シール登録
     */
    public function store2(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            // 'package_id' => 'required',
        ]);

        $posts = $request->all();

        $image = $request->file('image');
        // $imageを公開状態でs3のsealフォルダに保存
        $path = Storage::disk('s3')->putFile('seal', $image, 'public');
        // 画像のURLを取得
        $url = Storage::disk('s3')->url($path);

        // トランザクション
        try {
            DB::beginTransaction();

            // Sealテーブルに挿入
            $sealId = Seal::insertGetId([
                'package_id' => $posts['package'],
                'name' => $posts['name'],
                'image' => $url, // DBにはURLを保存
                'favorite' => 1,
            ]);

            // tagを挿入する準備
            $tags = [];
            foreach ($posts['tags'] as $key => $tag) {
                $tags[$key] = [
                    'seal_id' => $sealId,
                    'name' => $tag['name'],
                ];
            }

            // Tagテーブルに挿入
            Tag::insert($tags);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            \Log::debug(print_r($th->getMessage(), true));
            throw $th;
        }

        // フラッシュメッセージ
        flash()->success('シールを登録しました。');

        return redirect()->route('seals.create');
    }

    /**
     * シール1件画面
     */
    public function show(string $id)
    {
        // リレーションで他テーブルの値を一緒に取得
        $seal = Seal::with('package', 'tags')
            // 指定のidと一致するカラムに絞る
            ->where('id', $id)
            ->first();

        return view('seals.show', compact('seal'));
    }

    /**
     * お気に入り
     */
    public function favorite(string $id)
    {
        $seal = Seal::find($id);

        // favoriteカラムの値が0なら1、1なら0に変更
        $seal->favorite = $seal->favorite == 0 ? 1 : 0;
        $seal->save();

        return redirect()->route('seals.show', $id);
    }

    /**
     *編集画面
     */
    public function edit(string $id)
    {
        // リレーションで他テーブルの値を一緒に取得
        $seal = Seal::with('package', 'tags')
            // 指定のidと一致するカラムに絞る
            ->where('seals.id', $id)
            ->first();

        $packages = Package::all();

        return view('seals.edit', compact('seal', 'packages'));
    }

    /**
     *シール更新
     */
    public function update(Request $request, string $id)
    {
        $posts = $request->all();

        // 更新する項目の配列
        $update_array = [
            'package_id' => $posts['package'],
            'name' => $posts['name'],
        ];
        // 画像の更新がある場合
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imageを公開状態でs3のrecipeフォルダに保存
            $path = Storage::disk('s3')->putFile('recipe', $image, 'public');
            // 画像のURLを取得
            $url = Storage::disk('s3')->url($path);
            // 配列にimageを追加
            $update_array['image'] = $url;
        }

        // トランザクション
        try {
            DB::beginTransaction();

            Seal::where('id', $id)->update($update_array);

            // 一度削除
            Tag::where('seal_id', $id)->delete();

            // tagをインサートする準備
            $tags = [];
            foreach ($posts['tags'] as $key => $tag) {
                $tags[$key] = [
                    'seal_id' => $id,
                    'name' => $tag['name'],
                ];
            }

            Tag::insert($tags);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            \Log::debug(print_r($th->getMessage(), true));
            throw $th;
        }

        // フラッシュメッセージ
        flash()->success('シールを更新しました。');

        return redirect()->route('seals.show', ['seal' => $id]);
    }

    /**
     * シール削除
     */
    public function destroy(string $id)
    {
        Seal::where('id', $id)->delete();

        flash()->error('シールを削除しました。');

        return redirect()->route('seals.index');
    }


    /**
     * パッケージ一覧画面
     */
    public function index2()
    {
        $packages = Package::orderBy('id', 'desc')->get();

        return view('seals.index2', compact('packages'));
    }

        /**
     *パッケージ編集画面
     */
    public function edit2(string $id)
    {
        $package = Package::all()
            ->where('id', $id)
            ->first();

        return view('seals.edit2', compact('package'));
    }

    /**
     *パッケージ更新
     */
    public function update2(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        // パッケージの取得と更新
        $package = Package::findOrFail($id); // IDに対応するパッケージを取得
        $package->name = $validated['name']; // バリデーション済みの名前を設定
        $package->save(); // パッケージを保存

        // フラッシュメッセージ
        flash()->success('パッケージを更新しました。');

        return redirect()->route('packages.index');
    }

    /**
     * パッケージ削除
     */
    public function destroy2(string $id)
    {
        Package::where('id', $id)->delete();

        flash()->error('パッケージを削除しました。');

        return redirect()->route('packages.index');
    }
}
