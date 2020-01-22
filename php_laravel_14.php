<?php

//【PHP/Laravel 14 投稿データを保存しよう】の課題


/*課題1
データベースとテーブルの関係を説明してください。*/
//テーブルとは、行と列をもつ表の形で表されたデータのことであり、テーブルを複数集めて使いやすく整理したものをデータベースという。


/*課題2
テーブルを作成するときに事前にしなければならないことはなんですか？*/
//テーブルがもつ列（カラム）の数と各列のデータ名を決めておくこと。


/*課題3
Validationはどのような役目をしていますか？*/
//テーブルに格納される情報がテーブルに必要な情報をそろえているかを事前に確認すること。


/*課題4
【応用】 create_profiles_table というMigrationの雛形ファイルを作成し、 profilesというテーブル名で名前(name)、性別(gender)、趣味(hobby)、自己紹介(introduction)を保存できるように修正して、 migrateしてテーブルを作成しましょう。*/



//---------------------------------------------------------------------------------
database/migrationsにcreate_profiles_tableを作成


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('gender');
            $table->string('hobby');
            $table->string('introduction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
/*----------------------------------------------------------------------------------
これにより以下のテーブルが作成された。
+--------------+---------------------+------+-----+---------+----------------+
| Field        | Type                | Null | Key | Default | Extra          |
+--------------+---------------------+------+-----+---------+----------------+
| id           | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name         | varchar(255)        | NO   |     | NULL    |                |
| gender       | varchar(255)        | NO   |     | NULL    |                |
| hobby        | varchar(255)        | NO   |     | NULL    |                |
| introduction | varchar(255)        | NO   |     | NULL    |                |
| created_at   | timestamp           | YES  |     | NULL    |                |
| updated_at   | timestamp           | YES  |     | NULL    |                |
+--------------+---------------------+------+-----+---------+----------------+
7 rows in set (0.00 sec)
-----------------------------------------------------------------------------------
*/





/*課題5
【応用】 Modelを作成するコマンドで Profile というModelを作成し、 名前(name)、性別(gender)、趣味(hobby)、自己紹介(introduction)に対してValidationをかけるようにしてみましょう。*/
/*
-----------------------------------------------------------------------------------
作成したProfile.phpを以下のように編集した。*/
mynews/app/Profile.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = ['id'];
    //
    public static $rules = [
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    ];
}

//---------------------------------------------------------------------------------
/*エラーメッセージが日本語で表示されるように、mynews/resources/lang/ja/validation.phpを以下のように編集した。*/
mynews/resources/lang/ja/validation.php

    'attributes' => [
        'title' => 'タイトル',
        'body' => '本文',
        
        //以下4行を追記
        
        'name' => '名前',
        'gender' => '性別',
        'hobby' => '趣味',
        'introduction' => '自己紹介欄',
        ],
//---------------------------------------------------------------------------------




/*課題6
【応用】 resources/views/admin/profile/create.blade.php を開いて、Validationでエラーが発生した場合にエラーが表示されるようになっているか確認してみましょう。
※4、5、6につきましては、作成したソースコードをGitHubにプッシュした上、
該当リポジトリのURLを課題一覧機能より提出してください。*/

/*
---------------------------------------------------------------------------------*/
mynews/resources/views/admin/profile/create.blade.phpは問題なし。以下にコードを示す。

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール新規作成</h2>
                 <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    //続く、、、
/*---------------------------------------------------------------------------------*/
次にmynews/app/Http/Controllers/Admin/ProfileController.phpを編集。以下にコードを示す。


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;  //Validationのためにこの1行も追記


class ProfileController extends Controller
{

    public function add()
    {
        return view('admin.profile.create');
    }


//以下createアクションをValidationのために編集
//サンプルコードにはformから送られてきたimageに関する処理が記述されていたが、ここでは削除した。
    public function create(Request $request)          //()内に　Request $request　を記述。
    {

      $this->validate($request, Profile::$rules);     //サンプルコード中のNewsをProfileに変更。

      $profile = new Profile;                         //同じくProfileに変更。$newsは$profileに変更。
      $form = $request->all();

      

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $profile->fill($form);
      $profile->save();
//ここまでをValidationのために編集
        
      return redirect('admin/profile/create');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
}

//---------------------------------------------------------------------------------
