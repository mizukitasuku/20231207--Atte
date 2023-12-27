<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>atte</title>
  <link rel="stylesheet" href="{{ asset('css/.css') }}" />
  @yield('css1')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo">Atte</a>
    </div>
  </header>

  <main>
    @yield('content1')
  </main>

  <footer class="footer">
    <small class="footer__logo">Atte, inc.</small>
  </footer>


</body>

</html>