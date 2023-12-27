<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;http://localhost/other-attendance?date=2023-12-05&user_id=
use Carbon\Carbon; // Carbon クラスをインポート
use App\Models\User;

class OtherController extends Controller
{
    public function userOther(Request $request)
    {
        $users = User::all(); // ここで $users 変数を定義

        $userId = $request->input('user_id'); // ユーザーIDを取得
            $date = $request->query('date', \Carbon\Carbon::today()->toDateString());

            // ユーザーIDが指定されていれば、そのユーザーのデータのみ取得
            $query = DB::table('users')
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
                ->groupBy('users.id', 'stamp.start_time', 'stamp.end_time'); // ここに GROUP BY 句を追加

            if ($userId) {
                $query->where('users.id', '=', $userId);
            }

            $attendances = $query->paginate(5);

            return view('other-attendance', compact('attendances', 'date', 'users'));
    }
}
