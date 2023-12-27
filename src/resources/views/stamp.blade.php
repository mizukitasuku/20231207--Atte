@extends('layouts.inner')

@section('css2')

@endsection







@section('content2')
<div class="login-form__content">
    <div class="contact-form__heading">
        <span>{{ Auth::user()->name }}さんお疲れ様です！</span>
    </div>
    <div class="box">
        <div class="box-top">
            <form class="form" action="{{ route('stamp.start') }}" method="post">
                @csrf
                <div class="form__button">
                    <button class="form__button-stamp-start" type="submit">勤務開始</button>
                </div>
            </form>
            <form class="form" action="{{ route('stamp.end') }}" method="post">
                @csrf
                <div class="form__button">
                    <button class="form__button-stamp-end" type="submit">勤務終了</button>
                </div>
            </form>
        </div>
        <div class="box-btm">
            <form class="form" action="{{ route('break.start') }}" method="post">
                @csrf
                <div class="form__button">
                    <button class="form__button-break-start" type="submit">休憩開始</button>
                </div>
            </form>
            <form class="form" action="{{ route('break.end') }}" method="post">
                @csrf
                <div class="form__button">
                    <button class="form__button-break-end" type="submit">休憩終了</button>
                </div>
            </form>
        </div>
    </div>
</div>

















@endsection