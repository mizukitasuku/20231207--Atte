<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStampTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamp', function (Blueprint $table) {
            $table->id(); // 自動的に unsigned big integer として設定される
            $table->unsignedBigInteger('users_id'); // users テーブルの id に対する外部キーとして
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable(); // nullable() は終了時刻がない場合にNULLを許容する
            $table->timestamps(); // created_at と updated_at の両方を作成する

            // 外部キー制約を設定
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
