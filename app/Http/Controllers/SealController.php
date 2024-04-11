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
     * シール登録画面
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
            ->where('seals.id', $id)
            ->first();

        return view('seals.show', compact('seal'));
    }

    /**
     *指定したリソースを編集するためのフォームを表示する。
     */
    public function edit(string $id)
    {
        //
    }

    /**
     *ストレージ内の指定されたリソースを更新する。
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * 指定されたリソースをストレージから削除する。
     */
    public function destroy(string $id)
    {
        //
    }
}
