<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //DB操作をするためのファザード

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // DBからsealsテーブルのid値を取得し配列にする
        // $seals = DB::table('seals')->pluck('id')->toArray();
        // $tag_names = ['うさぎ', 'お花', '植物', 'サンリオ', 'ダイソー', '韓国', '文字', 'くま', 'ねこ', 'たべもの', 'おかし', 'ハート', 'ケーキ'];

        // // sealの数だけ実行
        // foreach ($seals as $seal) {
        //     for ($i = 0; $i < rand(2, 8); $i++) { //2～8回実行
        //         DB::table('tags')->insert([
        //             'seal_id' => $seal,
        //             'name' => $tag_names[array_rand($tag_names)], //↑の配列からランダムに取得
        //         ]);
        //     }
        // }
    }
}