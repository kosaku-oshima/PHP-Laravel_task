<?php

//【PHP/Laravel 10 ControllerとViewが連携できるようにしよう】の課題


/*課題1
Viewは何をするところでしょうか。簡潔に説明してみてください。*/
/*特定のURLに対し、あらかじめコントローラーによって指定されていた画面のビジュアルに関するデータを呼び出すところ。*/

/*課題2
プログラマーがhtmlを書かずにPHPなどのプログラミング言語やフレームワークを使う必要があるのはどういった理由でしょうか。*/
/*ユーザーの画面上に表示される内容を各ユーザーの操作ごとに分けるため。
各ユーザーの入力内容の違いなどを画面上に反映させるために必要。*/

/*課題3
【応用】 前々章でAdmin/ProfileControllerのadd Action, edit Action に次のように記述しました。
  public function add()
  {
      return view('admin.profile.create');
  }
  public function edit()
  {
      return view('admin.profile.edit');
  }
  この場合、add Action と edit Action を描画するには、それぞれどこのディレクトリに何というbladeファイルを設置すれば良いでしょうか。*/
  
/*addアクションはadmin/profileディレクトリ配下にcreate.blade.phpというファイルを設置する。
editアクションはadmin/profileディレクトリ配下にedit.blade.phpというファイルを設置する。*/
 
 
/*課題4
【応用】 3. の答えを実際に作成してみましょう。また、作成したbladeファイルにhtmlで記述して装飾してみましょう。
※4につきましては、作成したソースコードをGitHubにプッシュした上、
該当リポジトリのURLを課題一覧機能より提出してください。*/

/*【admin/profile/create.blade.php】
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add関数</title>
    </head>
    <body>
        <h1>課題4によるadd関数の呼び出しに成功！</h1>        
    </body>
</html>*/


/*【admin/profile/edit.blade.php】
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit関数</title>
    </head>
    <body>
        <h1>課題4によるedit関数の呼び出しに成功！</h1>
   </body>
</html>
*/



?>
