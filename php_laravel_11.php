<?php

/*課題1
Bladeテンプレートで、埋め込みたい箇所に利用するワードは何だったでしょうか？*/
//@yield('')

/*課題2
Webpackで使われているBootstrapやSCSSはどういったものか、調べられる範囲で調べてみましょう。*/




/*課題3
【応用】 resources/views/layouts/admin.blade.php をコピーして profile.blade.php を同じディレクトリ（resources/views/layouts）に作成しましょう。また、以下の部分を下の※1のように修正しましょう。*/
/*※1
        {{-- 次の1行を削除 --}}
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
        {{-- 次の1行を追記 --}}
        <link href="{{ secure_asset('css/profile.css') }}" rel="stylesheet">*/
//やった。



/*課題4
【応用】 プロフィール作成画面用に、resources/views/admin/profile/create.blade.php ファイルを作成し、3. で作成した profile.blade.phpファイルを読み込み、また プロフィールのページであることがわかるように titleとcontentを編集しましょう。（ヒント: resources/views/admin/news/create.blade.php を参考にします。）*/
/*以下create.blade.phpのコード
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Profile</title>
    </head>
    <body>
        <h1>プロフィール作成画面</h1>
<!-- ------------------------------------------------------------------------------ -->      
<!--{{-- layouts/profile.blade.phpを読み込む --}}-->
@extends('layouts.profile')


<!--{{-- profile.blade.phpの@yield('title')に'プロフィールの新規作成'を埋め込む --}}-->
@section('title', 'プロフィールの新規作成')

<!--{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}-->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール新規作成</h2>
            </div>
        </div>
    </div>
@endsection

<!-- ------------------------------------------------------------------------------ -->
    </body>
</html>
*/


/*課題5
【応用】 resources/sass/admin.scss をコピーして profile.scss をresources/sassに作成しましょう。後ほどこちらは課題で編集します。*/
//やった。


/*課題6
【応用】 webpack.mix.jsを編集して、profile.scss をコンパイルするように編集してみましょう。*/
/*webpack.jsに以下を追記
   .sass('resources/sass/profile.scss', 'public/css');*/


/*課題7
【応用】 6. ができたら、実際に npm run watch コマンドでコンパイルしてみましょう。*/
//やった。

/*課題8
【応用】 7. ができたら、ブラウザで /admin/profile/createでプロフィール作成画面が表 示されるか確認しましょう。*/
//表示された。


?>