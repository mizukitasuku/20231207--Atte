@extends('layouts.inner')

@section('css2')

@endsection


@section('content2')
<div class="form-box">
    <h2>{{ $attendance->user_name }}</h2>
    {{-- ユーザー選択ドロップダウンの直前にエラーハンドリングを追加 --}}
    @if(isset($users))
        {{-- ユーザー選択ドロップダウン --}}
        {{-- ... --}}
    <form action="{{ url('other-attendance') }}" method="GET">
        <div>
            <select name="user_id">
                <option value="">全てのユーザー</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date', \Carbon\Carbon::today()->toDateString()) }}">
            <button type="submit">表示</button>
        </div>
    </form>
    @else
        <p>ユーザー情報をロードできませんでした。</p>
    @endif
    @php
        $date = request('date', \Carbon\Carbon::today()->toDateString());
        $yesterday = \Carbon\Carbon::parse($date)->subDay()->toDateString();
        $tomorrow = \Carbon\Carbon::parse($date)->addDay()->toDateString();
    @endphp
    <div>
        <a href="{{ url('other-attendance') }}?date={{ $yesterday }}&user_id={{ request('user_id') }}">前日</a>
        <a href="{{ url('other-attendance') }}?date={{ $tomorrow }}&user_id={{ request('user_id') }}">翌日</a>
    </div>
    <form class="form" action="/" method="post">
        @csrf
        <div class="form__text">
            <table>
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>勤務開始</th>
                        <th>勤務終了</th>
                        <th>休憩時間</th>
                        <th>勤務時間</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user_name }}</td>
                        <td>{{ $attendance->stamp_start }}</td>
                        <td>{{ $attendance->stamp_end }}</td>
                        <td>{{ $attendance->total_break_time }}</td>
                        <td>{{ $attendance->work_time }}</td> {{-- 勤務時間を分単位で表示 --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- {{-- ページネーションリンク --}} -->
            <div class="pagination">
                {{ $attendances->appends(['date' => $date, 'user_id' => request('user_id')])->links() }}
            </div>
        </div>
    </form>
</div>
@endsection