<?php

//【PHP/Laravel 09 Routingについて理解する】の課題

/*課題1
URLとControllerやActionを紐付ける機能を何といいますか？*/
//Routing




/*課題2
あなたが考える、group化をすることのメリットを考えてみてください。*/
/*グループ化するといくつかのアクションに紐づけられたURLに共通部分が生まれる。
したがって、Routingの設定から各アクションが同じページにおける操作によって呼び出されるものなのかといった関係を把握しやすくなり、システムのメンテナンスや変更がしやすくなる。
また、Routing設定の記述場所を一か所に集めることにもなり、システムの処理速度が上昇する可能性もあると考えられる。*/



/*課題3
「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください。*/
Route::get('XXX' , 'AAAController@bbb');


/*課題4
【応用】 前章でAdmin/ProfileControllerを作成し、add Action, edit Actionを追加しました。web.phpを編集して、admin/profile/create にアクセスしたら ProfileController の add Action に、admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定してください。*/
//web.phpに以下を追記
Route::group(['prefix' => 'admin'], function(){
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    });




//※3、4につきましては作成したソースコードをGitHubにプッシュした上、該当リポジトリのURLを課題一覧機能より提出してください。



?>