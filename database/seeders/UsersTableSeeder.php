<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; //ハッシュ変換機能を使用

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'テスト', 'email' => 'test@test.com', 'password' => Hash::make('password123')],
            ['name' => 'テスト２', 'email' => 'test@test2.com', 'password' => Hash::make('password')],
            ['name' => 'テスト３', 'email' => 'test@test3.com', 'password' => Hash::make('password')],
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
