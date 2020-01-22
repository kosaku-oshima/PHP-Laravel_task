<?php

//【PHP/Laravel 17 編集履歴を実装しよう】の課題


/*課題1
【超応用】 プロフィールの更新履歴を保存する仕組みを作るにはどのようにしたらよいでしょうか。手順をまとめてみましょう。（どうしてもわからなからない場合はメンターに相談してみましょう。）*/
/*
プロフィールの編集画面で更新するたびにprofile_historiesテーブルにも記録を残すように設定する。
profile_historiesテーブルは四つのカラムをもち、それぞれid、profile_id、edited_at、timestampとする。
profile_historiesテーブルのデータはprofileHistoryモデルで出し入れすることにする。
また、profile_historiesテーブルにレコードを残すタイミングはプロフィールの更新を行うProfileControllerのupdateアクションが起動したときであるため、
updateアクションのRouteing設定をそのまま利用して中身だけ編集する。
手順をまとめると以下のようになる。

1.profile_historiesテーブルを作成
2.profileHistoryモデルを作成
3.ProfileモデルとprofileHistoryモデルを関連付ける
4.ProfileController.phpのupdateアクションを編集
5.編集画面のViewであるedit.blade.phpを編集

*/



/*課題2
【超応用】 1. ができたら実際にプロフィールの更新履歴を保存する仕組みを作成してみましょう。
※作成したソースコードをGitHubにプッシュした上、
該当リポジトリのURLを課題一覧機能より提出してください。*/


//------------------------------------------------------------------------------
/*
database/migrations/2020_01_19_021315_create_profile_histories_tableのコード*/


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->integer('profile_id');
            $table->string('edited_at');
            
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
        Schema::dropIfExists('profile_histories');
    }
}

//------------------------------------------------------------------------------

/*
app/profileHistory.phpのコード*/
namespace App;

use Illuminate\Database\Eloquent\Model;

class profileHistory extends Model
{
    //
    
    public static $rules = [
        'profile_id' => 'required',
        'edited_at' => 'required',
        ];
}
//------------------------------------------------------------------------------

/*
app/Profile.phpのコード*/

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
    
    
    public function profile_histories(){
        return $this->hasMany ('App\profileHistory');
        }
}
//------------------------------------------------------------------------------


/*ProfileControllerのコード*/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;  
use App\profileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();

      unset($form['_token']);
      $profile->fill($form);
      $profile->save();
      return redirect('admin/profile');
    }
    
      public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }


     public function edit(Request $request)
     {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);    
        }
        return view('admin.profile.edit',['profile_form' => $profile]);
     }

    public function update(Request $request)
    {        

      $this->validate($request, Profile::$rules);
      $profile = Profile::find($request->id);
      $profile_form = $request->all();
      unset($profile_form['_token']);
      $profile->fill($profile_form)->save();
      
      $profile_history = new profileHistory;
      $profile_history -> profile_id = $profile->id;
      $profile_history -> edited_at = Carbon::now();

      $profile_history -> save();
        
      return redirect('admin/profile');
    }
    
        
    public function delete(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->delete();
        return redirect('admin/profile');
    }  

}

//------------------------------------------------------------------------------
/*
resources/views/admin/profile/edit.blade.phpのコード*/

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

