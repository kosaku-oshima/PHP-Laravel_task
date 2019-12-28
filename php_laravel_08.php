<?php
/*
【PHP/Laravel 08 ControllerとRoutingの関係について理解しよう】の課題
*/
/*課題1
ControllerとRoutingについてわからないことを書き出してメンターに質問してみましょう。*/
/*課題2
Controllerの役割について、説明してください。*/
/*ControllerとはActionと呼ばれる任意の処理の塊を集めたものである。
Actionには、データベースを利用した情報のやり取りを行うものや、その情報を使ってPC上にどのような画面を表示するかを指定する処理が含まれる。
したがって、Controllerを利用することで、どのような情報をどういった表示方法で示すかを指定できる。*/


/*課題3
ControllerとRoutingの役割について、説明してください。*/
/*Routingは、システムの利用者が行った操作に対してController内の特定のActionを起動させる役割をもつ。
ControllerはPCへ画面の表示形式に関する情報を渡す。*/



/*課題4
【応用】 artisanを使って、Admin/ProfileControllerを作成しましょう。*/
/*課題5
【応用】 Admin/ProfileControllerに、以下のadd, create, edit, update それぞれのActionを追加してみましょう。
※4、5の課題につきましては、作成したソースコードをGitHubにプッシュした上、
該当リポジトリのURLを課題一覧機能より提出してください。*/
/*
以下Admin/ProfileControllerのコードを示す。
-----------------------------------------------------------
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //課題5で指定されたコードを記述
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create()
    {
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

-----------------------------------------------------------
*/



?>