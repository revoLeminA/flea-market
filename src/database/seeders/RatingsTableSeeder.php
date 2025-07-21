<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Provider\DateTime;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->insert([
            "evaluator_id" => 3,
            "evaluated_id" => 1,
            "item_id" => 5,
            "score" => 4,
            'created_at' => DateTime::dateTimeThisDecade(),
            'updated_at' => now(),
        ]);

        DB::table('ratings')->insert([
            "evaluator_id" => 3,
            "evaluated_id" => 2,
            "item_id" => 7,
            "score" => 3,
            'created_at' => DateTime::dateTimeThisDecade(),
            'updated_at' => now(),
        ]);
    }
}
