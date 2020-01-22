<?php

//【PHP/Laravel 13 ニュース投稿画面を作成しよう】の課題




/*課題1
GETメソッドとPOSTメソッドについて調べ、どのような違いがあるか説明してください。*/
/*
サーバーに対して情報をリクエストするとき、欲しい情報に関してどこに指定するのかで分かれる。
GETメソッドはURLに直接書き込んで指定するため、指定した内容がブラウザ上で見られるほか指定する文に文字数制限がかかったりする。
また、サイトのログイン時に使うとURLにログイン情報も残るため、ログイン後のマイページなどをブックマークできる。
POSTメソッドはメッセージボディに指定内容が書き込まれる。メッセージボディはブラウザ上に表示されないため、指定した内容がわかりにくく、文字数制限もない。
一般的に、ログイン時などブラウザで何か情報を書き込んだ後にリクエストする場合はPOSTメソッド、そうでなければGETメソッドという風に使い分ける。
*/


/*課題2
【応用】 GET/POSTメソッド以外にどのようなメソッドがあるか、またどのように使われるかを説明してください。*/
/*他によく使用されるのはPUTメソッドやDELETEメソッドである。PUTメソッドはPOSTメソッド同様ブラウザで情報を書き込んだ後のリクエストに使われ、
特にブラウザで既存の情報を新しく更新する際に多く使われる。DELETEメソッドは既存の情報を削除したい場合に使われる。*/



/*課題3
【応用】 routes/web.php を編集して、 admin/profile/create に postメソッドでアクセスしたら ProfileController の create Action に割り当てるように設定してください。*/
/*
以下routes/web.phpのコード*/
//-----------------------------------------------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    Route::post('profile/create', 'Admin\ProfileController@create')->middleware('auth');　　　//この行を追加
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//----------------------------------------------------------------------------------------------------------




/*課題4
【応用】 resources/views/admin/profile/create.blade.php を編集して、氏名(name)、性別(gender)、趣味(hobby)、自己紹介欄(introduction)を入力するフォームを作成してください。また、formの送信先(<form action=”この部分”>)を、 Admin\ProfileController の create Action に指定してください。(ヒント: resources/views/admin/news/create.blade.php)*/
/*以下、resources/views/admin/profile/create.blade.phpのコード*/
//--------------------------------------------------------------------------------------------------------------
@extends('layouts.profile')
@section('title', 'プロフィールの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール新規作成</h2>
                
                //以下formタグ内の内容を追記（性別の欄は選択式に変更）
                
                 <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                   <div class="form-group row">
                        <label class="col-md-2">性別</label>
                        <div class="col-md-10">
                            <select class="form-control" name="gender" >
                                <option value="">選択してください</option>
                                <option value="male">男性</option>
                                <option value="female">女性</option>
                                <option value="other">その他</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                        </div>
                    </div>
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                
                //以上までを追記
                
            </div>
        </div>
    </div>
@endsection
//--------------------------------------------------------------------------------------------------------------


/*課題5
【応用】 4. ができたら、 /admin/profile/create にアクセスしてみましょう。*/
//→問題なく動作した。



/*課題6
【応用】 routes/web.php を編集して、 admin/profile/edit に postメソッドでアクセスしたら ProfileController の update Action に割り当てるように設定してください。
※3, 4, 6につきましては、作成したソースコードをGitHubにプッシュした上、該当リポジトリのURLを課題一覧機能より提出してください。*/
/*
以下、routes/web.phpのコード*/
//-------------------------------------------------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create');
});


Route::group(['prefix' => 'admin'], function(){
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::post('profile/edit', 'Admin\ProfileController@update');                 //この行を追加
    });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//-------------------------------------------------------------------------------------------------------------
