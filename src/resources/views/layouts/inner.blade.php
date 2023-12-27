<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>atte</title>
  <link rel="stylesheet" href="{{ asset('css/.css') }}" />
  @yield('css2')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo">Atte</a>
    </div>
    <nav class="header__nav">
      <ul class="header__nav-box">
        @if (Auth::check())
        <li><a href="/">ホーム</a></li>
        <li><a href="/attendance">日付一覧</a></li>
        <li><a href="/user-attendance">ユーザー一覧</a></li>
        <li><a href="/other-attendance">ユーザー別勤怠ページ</a></li>
        <li>
          <form class="form" action="/logout" method="post">
            @csrf
            <button class="header__nav-button">ログアウト</button>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    @yield('content2')
  </main>
@endif
  <footer class="footer">
    <small class="footer__logo">Atte, inc.</small>
  </footer>

</body>

</html>