@extends('layouts.out')

@section('css1')

@endsection

@section('content1')
<div class="login-form__content">
    <div class="contact-form__heading">
        <h2>会員登録</h2>
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form__input">
            <div class="form__input--text">
                <input type="text" name="name" placeholder="名前" value="{{ old('name') }}" />
            </div>
            @error('name')
                <div class="form__error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form__input">
            <div class="form__input--text">
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
            </div>
            @error('email')
                <div class="form__error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form__input">
            <div class="form__input--text">
                <input type="password" name="password" placeholder="パスワード" />
            </div>
            @error('password')
                <div class="form__error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form__input">
            <div class="form__input--text">
                <input type="password" name="password_confirmation" placeholder="確認用パスワード" />
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">会員登録</button>
        </div>
    </form>
    <div class="contact-form__heading">
        <a>アカウントをお持ちの方はこちらから</a>
    </div>
    <div class="header__inner">
        <a class="header__logo" href="/login"">ログイン</a>
    </div>
</div>

@endsection