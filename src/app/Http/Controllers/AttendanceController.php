<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Carbon クラスをインポート

class AttendanceController extends Controller
{
    public function dataView(Request $request)
    {
        // クエリパラメータから日付を取得、デフォルトは今日の日付
        $date = $request->query('date', Carbon::today()->toDateString());

        // 日付が指定されている場合は、その日のデータでフィルタリング
        $attendances = DB::table('users')
            ->join('stamp', 'users.id', '=', 'stamp.users_id')
            ->leftJoin('breaks', 'stamp.id', '=', 'breaks.stamp_id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'stamp.start_time as stamp_start',
                'stamp.end_time as stamp_end',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, breaks.break_start, COALESCE(breaks.break_end, breaks.break_start))) as total_break_time'),
                DB::raw('TIMESTAMPDIFF(MINUTE, stamp.start_time, stamp.end_time) - SUM(TIMESTAMPDIFF(MINUTE, breaks.break_start, COALESCE(breaks.break_end, breaks.break_start))) as work_time')
            )
            ->whereDate('stamp.start_time', '=', $date)
            ->groupBy('users.id', 'stamp.start_time', 'stamp.end_time')
            ->paginate(5);

        // ビューにデータを渡す
        return view('attendance', compact('attendances', 'date'));
    }
}