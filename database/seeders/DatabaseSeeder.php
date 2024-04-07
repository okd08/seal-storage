<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 外部キー制約を考慮した順番で記述
            UsersTableSeeder::class,
            PackagesTableSeeder::class,
            SealsTableSeeder::class,
            TagsTableSeeder::class,
        ]);
    }
}