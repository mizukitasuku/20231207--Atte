<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Carbon クラスをインポート
use App\Models\User;

class UserController extends Controller
{
public function userPage(Request $request)
    {
    $users = User::paginate(10); // 例えばページあたり10ユーザーを表示する
        // ビューにデータを渡す
        return view('user-attendance', compact('users'));
    }

public function showUserDetails($id)
{
    $user = User::find($id);

    // 例: 勤務時間データを取得するクエリ
    $attendances = DB::table('stamp')
        ->where('users_id', $id)
        // 必要に応じて他の条件を追加
        ->get();

    return view('user-details', compact('user', 'attendances'));
}
}
