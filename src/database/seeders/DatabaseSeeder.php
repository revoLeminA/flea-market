<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ItemCategoriesTableSeeder::class);
        $this->call(PurchasesTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
        $this->call(ChatMessagesTableSeeder::class);
        $this->call(ChatNotificationsTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
    }
}
