<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    {{-- 共通CSS --}}
    <link rel="stylesheet" href="/css/common.css">

    {{-- ページごとのCSS --}}
    @yield('css')
</head>
<body>

    <header class="header">
        <img src="{{asset('images/CoachTech_White 1.png')}}" class="site-title" ></img>

        {{-- ページごとにヘッダーへ追加したいもの --}}
        <div class="header-buttons">
            @yield('header-buttons')
            <a href="/sell" class="sell-button">出品</a>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>
