<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //DB操作をするためのファザード
use Illuminate\Support\Str; //文字列関連の便利なメソッドを使用

class SealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DBからpackageテーブルのid値を取得し配列にする
        $packages = DB::table('packages')->pluck('id')->toArray();

        $image_types = ['cake', 'candy', 'sweets', 'rainbow', 'flower', 'heart', 'star', 'sky', 'gummy', 'cookie', 'fruits'];

        // 20回実行
        for ($i = 0; $i < 50; $i++) {
            DB::table('seals')->insert([
                'package_id' => $packages[array_rand($packages)], //packagesテーブルのidからランダムで選ぶ
                'name' => Str::random(10),
                'image' => 'https://source.unsplash.com/random/?' . $image_types[rand(0, 10)], //ランダムに画像を取得
            ]);
        }
    }
}
