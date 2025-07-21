<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Provider\DateTime;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert([
            "id" => 1,
            'buyer_id' => 3,
            'seller_id' => 1,
            'item_id' => 1,
            'created_at' => DateTime::dateTimeThisDecade(),
            'updated_at' => now(),
        ]);

        DB::table('chats')->insert([
            "id" => 2,
            'buyer_id' => 3,
            'seller_id' => 2,
            'item_id' => 10,
            'created_at' => DateTime::dateTimeThisDecade(),
            'updated_at' => now(),
        ]);
    }
}
