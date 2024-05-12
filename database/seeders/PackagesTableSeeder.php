<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //DB操作をするためのファザード

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            ['name' => 'うさぎパック', 'user_id' => 1],
            ['name' => 'お花パック', 'user_id' => 1],
            ['name' => 'いちごパック', 'user_id' => 1],
            ['name' => 'マイメロパック', 'user_id' => 1],
            ['name' => '惑星パック', 'user_id' => 1],
        ];

        foreach ($packages as $package) {
            DB::table('packages')->insert($package);
        }
    }
}
