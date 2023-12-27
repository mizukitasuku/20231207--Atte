<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // この行を追加

class StampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // `stamp` テーブル用のダミーデータの生成
        $stampData = [
            'users_id'    => 4, // 既存のユーザーIDを想定
            'start_time'  => Carbon::now()->subHours(8), // 8時間前
            'end_time'    => Carbon::now(), // 現在時刻
            'created_at'  => Carbon::now()->subHours(8), // 8時間前
            'updated_at'  => Carbon::now(), // 現在時刻
        ];

        // `stamp` テーブルに挿入
        DB::table('stamp')->insert($stampData);
    }
}
