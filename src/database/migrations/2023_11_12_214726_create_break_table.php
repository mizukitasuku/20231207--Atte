<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakTable extends Migration
{
    public function up()
    {
        Schema::create('breaks', function (Blueprint $table) {
            $table->id(); // プライマリーキー
            $table->unsignedBigInteger('stamp_id'); // 'stamps'テーブルへの外部キー
            $table->timestamp('break_start'); // 休憩開始時間
            $table->timestamp('break_end')->nullable(); // 休憩終了時間、NULLを許容
            $table->timestamps(); // created_at と updated_at の両方を作成する

            // stampsテーブルのidカラムへの外部キー制約
            $table->foreign('stamp_id')->references('id')->on('stamps')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('breaks');
    }
}
