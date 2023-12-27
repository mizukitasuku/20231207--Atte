@extends('layouts.out')

@section('css1')

@endsection







@section('content1')
<div class="login-form__content">
    <div class="contact-form__heading">
        <h2>ログイン</h2>
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__input">
            <div class="form__input--text">
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
            </div>
        </div>
        <div class="form__input">
            <div class="form__input--text">
                <input type="password" name="password" placeholder="パスワード" />
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
    <div class="contact-form__heading">
        <a>アカウントをお持ちでない方はこちらから</a>
    </div>
    <div class="header__inner">
        <a class="header__logo" href="/register">会員登録</a>
    </div>
</div>
@endsection