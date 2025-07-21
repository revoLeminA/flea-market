<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat_messages')->insert([
            'chat_id' => 1,
            'sender_id' => 3,
            'message' => "はじめまして。腕時計の出品を拝見しました。\n商品状態についてもう少し詳しく教えていただけますか？\n目立つキズや不具合などはありますか？",
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5),
        ]);

        DB::table('chat_messages')->insert([
            'chat_id' => 1,
            'sender_id' => 1,
            'message' => "ご連絡ありがとうございます。\n目立つキズはなく、全体的にきれいな状態です。\nガラス面・ベルト部分にも大きなダメージはありません。\n動作も問題なく、購入時の箱と保証書も付属しています。",
            'created_at' => now()->subDays(4),
            'updated_at' => now()->subDays(4),
        ]);

        DB::table('chat_messages')->insert([
            'chat_id' => 1,
            'sender_id' => 3,
            'message' => "ご丁寧にありがとうございます。\n着用感が分かる写真をもう1枚追加していただくことは可能でしょうか？",
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(3),
        ]);

        DB::table('chat_messages')->insert([
            'chat_id' => 2,
            'sender_id' => 3,
            'message' => "はじめまして。メイクセットの出品、拝見しました。\nとても状態が良さそうで、気になっています！\n大変恐縮ですが、こちらの商品を 2,200円 にお値下げいただくことは可能でしょうか？\n即購入を検討しています。",
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(2),
        ]);

        DB::table('chat_messages')->insert([
            'chat_id' => 2,
            'sender_id' => 2,
            'message' => "ご連絡ありがとうございます！\n商品にご関心をお持ちいただきうれしいです。",
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        DB::table('chat_messages')->insert([
            'chat_id' => 2,
            'sender_id' => 2,
            'message' => "まだ出品したばかりなので迷っていますが、少しお時間いただけますか？\nできるだけご希望に添えるよう検討してみます。",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
