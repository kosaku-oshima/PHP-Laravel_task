<?php

/*課題1
【応用】 resources/views/layouts/profile.blade.php も編集して、 プロフィール編集画面にもログインリンクやログアウトリンクを表示するようにカスタマイズしましょう。*/
/*以下がresources/views/layouts/profile.blade.phpのコード
---------------------------------------------------------------------------------------------
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--{{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}-->
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ secure_asset('css/profile.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <!--{{-- 画面上部に表示するナビゲーションバーです。 --}}-->
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                             {{-- 以下を追記 --}}
                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                            {{-- 以上までを追記 --}}
                        </ul>
                    </div>
                </div>
            </nav>
            <!--{{-- ここまでナビゲーションバー --}}-->

            <main class="py-4">
                <!--{{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}-->
                @yield('content')
            </main>
        </div>
    </body>
</html>
---------------------------------------------------------------------------------------------


/*課題2
【応用】11章で /admin/profile/create にアクセスしたら ProfileController の add Action に割り当てるように設定しました。 ログインしていない状態で /admin/profile/create にアクセスした場合にログイン画面にリダイレクトされるように設定しましょう。*/
/*以下、mynews/routes/web.phpのコード
---------------------------------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    });




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
---------------------------------------------------------------------------------------------
*/


/*課題3
【応用】同様に 11章で /admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定しました。 ログインしていない状態で /admin/profile/edit にアクセスした場合にログイン画面にリダイレクトされるように設定しましょう。
コードは同上。

※作成したソースコードをGitHubにプッシュした上、
該当リポジトリのURLを課題一覧機能より提出してください。*/