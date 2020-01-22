<?php

//【PHP/Laravel 16 投稿したニュースを更新/削除しよう】の課題



/*課題1
【応用】 ProfileControllerを編集して、admin/profile/createから送信されてきたフォーム情報をデータベースに保存するようにしましょう。(ヒント: NewsController 参照)*/
//【PHP/Laravel 14 投稿データを保存しよう】の課題で完成済み



/*課題2
【応用】　1. までできたら、実際に /admin/profile/create からフォームを送信して保存してみましょう。*/
//できた。


/*課題3
【応用】 resources/views/admin/news/edit.blade.phpを参考にして、プロフィール編集画面用 に、resources/views/admin/profile/edit.blade.php ファイルを作成してください。 
このファイルでは layouts/profile.blade.phpファイルを読み込み、またプロフィールのページであることがわかるように titleとcontentを編集しましょう。 
さらに、氏名(name)、性別(gender)、趣味(hobby)、自己紹介欄(introduction)を入力するフォームを作成してください。 また、formの送信先(<form action=” この部分”>)を、 Admin¥ProfileController の update Action に指定してください。*/

//以下resources/views/admin/profile/edit.blade.phpのコード
@extends('layouts.profile')
@section('title', 'プロフィールの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="gender">性別</label>
                        <div class="col-md-10">
                             <select class="form-control" name="gender">
                                <option value="{{$profile_form->gender}}">{{$profile_form->gender}}</option>
                                <option value="男性">男性</option>
                                <option value="女性">女性</option>
                                <option value="その他">その他</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="hobby">趣味</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ $profile_form->hobby }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="introduction">自己紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ $profile_form->introduction}}</textarea>
                        </div>
                    </div>                    
                    
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profile_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profile_form->profile_histories != NULL)
                                @foreach ($profile_form->profile_histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
@endsection

/*課題4
【応用】 3. ができたら、 /admin/profile/edit にアクセスしてみましょう。
※作成したソースコードをGitHubにプッシュした上、
該当リポジトリのURLを課題一覧機能より提出してください。*/