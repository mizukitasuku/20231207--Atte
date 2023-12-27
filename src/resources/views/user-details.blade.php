@extends('layouts.inner')

@section('css2')

@endsection


@section('content2')
<div class="form-box">
{{-- ユーザー情報の表示 --}}
<h2>{{ $user->name }}の勤務時間</h2>

{{-- 勤務時間の表示 --}}
@foreach ($attendances as $attendance)
    {{-- 勤務時間情報の表示 --}}
@endforeach

@endsection