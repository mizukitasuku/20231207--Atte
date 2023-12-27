<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StampController extends Controller
{
    public function stampView()
    {
        return view('stamp');
    }

public function stampStart(Request $request)
{
    $userId = auth()->id();
    $currentTime = Carbon::now();

    // 今日の出勤記録を検索
    $todayStamp = DB::table('stamp')
        ->where('users_id', $userId)
        ->whereDate('start_time', $currentTime->toDateString())
        ->first();

    // 今日の出勤記録がすでに存在する場合はエラーメッセージを返す
    if ($todayStamp) {
        return back()->with('status', '本日の出勤時間は既に記録されています。');
    }

    // 出勤記録をデータベースに挿入
    DB::table('stamp')->insert([
        'users_id' => $userId,
        'start_time' => $currentTime,
        'created_at' => $currentTime,
        'updated_at' => $currentTime
    ]);

    return back()->with('status', '出勤時間が記録されました。');
}

public function stampEnd(Request $request)
{
    $userId = auth()->id();
    $currentTime = Carbon::now();

    // 最後に開始された勤務記録を検索
    $lastStamp = DB::table('stamp')
        ->where('users_id', $userId)
        ->whereNull('end_time')
        ->latest('start_time')
        ->first();

    // 出勤記録がない場合は退勤時間を記録しない
    if (!$lastStamp) {
        return back()->with('status', '出勤記録がありません。退勤時間を記録できません。');
    }

    // 出勤時の日付を取得
    $startDay = Carbon::parse($lastStamp->start_time)->startOfDay();
    $endDay = $startDay->copy()->endOfDay();

    // 現在時刻が出勤時の日付と同じでない場合は退勤時間を記録しない
    if (!$currentTime->between($startDay, $endDay)) {
        return back()->with('status', '日付が変わったため、退勤時間は記録されません。');
    }

    // 退勤時間を更新する
    DB::table('stamp')
        ->where('id', $lastStamp->id)
        ->update([
            'end_time' => $currentTime,
            'updated_at' => $currentTime
        ]);

    return back()->with('status', '退勤時間が記録されました。');
}


public function breakStart(Request $request)
{
    $userId = auth()->id();
    $currentTime = Carbon::now();

    // 現在の勤務記録を取得
    $currentStamp = $this->getCurrentStamp($userId);

    // 現在の勤務記録がない、または既に終了している場合は休憩を開始できない
    if (!$currentStamp || $currentStamp->end_time) {
        return back()->with('status', '現在勤務中ではありません。');
    }

    // ユーザーの最後の未終了休憩記録を取得
    $ongoingBreak = DB::table('breaks')
        ->where('stamp_id', $currentStamp->id)
        ->whereNull('break_end')
        ->latest('break_start')
        ->first();

    // 既に休憩中であれば新しい休憩を開始しない
    if ($ongoingBreak) {
        return back()->with('status', '既に休憩中です。');
    }

    // データベースの `breaks` テーブルに新しい休憩開始記録を挿入
    DB::table('breaks')->insert([
        'stamp_id' => $currentStamp->id,
        'break_start' => $currentTime,
        'created_at' => $currentTime,
        'updated_at' => $currentTime
    ]);

    return back()->with('status', '休憩開始時間が記録されました。');
}

public function breakEnd(Request $request)
{
    $userId = auth()->id();

    // 現在の勤務記録を取得
    $currentStamp = $this->getCurrentStamp($userId);

    // 勤務記録がない、または勤務が終了している場合は休憩を終了できない
    if (!$currentStamp || $currentStamp->end_time) {
        return back()->with('status', '現在勤務中ではありません。');
    }

    $currentTime = Carbon::now();

    // 最後の休憩開始記録を取得
    $lastBreak = DB::table('breaks')
        ->where('stamp_id', $currentStamp->id)
        ->whereNull('break_end')
        ->latest('break_start')
        ->first();

    // 休憩終了時間を更新
    if ($lastBreak) {
        DB::table('breaks')
            ->where('id', $lastBreak->id)
            ->update([
                'break_end' => $currentTime,
                'updated_at' => $currentTime
            ]);
        return back()->with('status', '休憩終了時間が記録されました。');
    } else {
        return back()->with('status', '休憩開始記録が存在しません。');
    }


    }

    protected function getCurrentStamp($userId)
    {
    // 最後に開始された勤務記録を取得
    return DB::table('stamp')
        ->where('users_id', $userId)
        ->whereNull('end_time')
        ->latest('start_time')
        ->first();
    }
}
