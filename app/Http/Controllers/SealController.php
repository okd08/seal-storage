<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seal;
use App\Models\Package;

class SealController extends Controller
{
    /**
     * シール一覧画面、検索
     */
    public function index(Request $request)
    {
        // sealテーブルとpackageテーブルの値(リレーション関数を実行)を取得
        $query = Seal::with(['package'])
            // 降順にする
            ->orderBy('id', 'desc');

        // リクエストを取得
        $filters = $request->all();


            // dd($filters);

        // リクエストがあった場合
        if (!empty($filters)) {
            // カテゴリ―検索
            if (!empty($filters['package'])) {
                $query->where('package_id', $filters['package']);
            }
            // キーワード検索
            if (!empty($filters['keyword'])) {
                $query->where('name', 'LIKE', '%' . $filters['keyword'] . '%');
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
        return view('seals.create');
    }

    /**
     * 新しく作成したリソースをストレージに格納する。
     */
    public function store(Request $request)
    {
        //
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
