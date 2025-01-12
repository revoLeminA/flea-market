<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "id" => 1,
            "category_name" => 'ファッション'
        ]);

        Category::create([
            "id" => 2,
            "category_name" => '家電'
        ]);

        Category::create([
            "id" => 3,
            "category_name" => 'インテリア'
        ]);

        Category::create([
            "id" => 4,
            "category_name" => 'レディース'
        ]);

        Category::create([
            "id" => 5,
            "category_name" => 'メンズ'
        ]);

        Category::create([
            "id" => 6,
            "category_name" => 'コスメ'
        ]);

        Category::create([
            "id" => 7,
            "category_name" => '本'
        ]);

        Category::create([
            "id" => 8,
            "category_name" => 'ゲーム'
        ]);

        Category::create([
            "id" => 9,
            "category_name" => 'スポーツ'
        ]);

        Category::create([
            "id" => 10,
            "category_name" => 'キッチン'
        ]);

        Category::create([
            "id" => 11,
            "category_name" => 'ハンドメイド'
        ]);

        Category::create([
            "id" => 12,
            "category_name" => 'アクセサリー'
        ]);

        Category::create([
            "id" => 13,
            "category_name" => 'おもちゃ'
        ]);

        Category::create([
            "id" => 14,
            "category_name" => 'ベビー・キッズ'
        ]);
    }
}
