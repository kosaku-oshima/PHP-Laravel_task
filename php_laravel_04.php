<?php

//【PHP/Laravel 04 関数を理解しよう】の課題



/*課題1
引数に数値を指定して実行すると、数値を2倍にして返す関数を作成してください*/
function doubleNumber($number){
    return $number*2;
}
echo doubleNumber(4);


//----------------------------------------------------------------------------------
/*課題2
2.$a と $b を仮引数に持ち、　$a と $b　を足した結果を返す関数を作成してください。*/
function sum($a, $b){
    return $a + $b;
}
echo sum(3,8);


//----------------------------------------------------------------------------------
/*課題3
$arr という配列の仮引数を持ち、数値が入った配列array(1, 3, 5 ,7, 9) を渡すとその要素をすべてかけた結果を返す関数を作成してください。*/
function multiNum($arr){
    $multipledNum = 1;
    foreach($arr as $ar){
        $multipledNum *= $ar;
    }
    echo $multipledNum;
}
$arr = array(1, 3, 5 ,7, 9);
multiNum($arr);


//----------------------------------------------------------------------------------
/*課題4
【応用】　次のプログラムは、配列の中で一番大きい値を返す max_array という関数を実装しようとしています。途中の部分を完成させてください。*/

function max_array($numbers){
// とりあえず配列の最初の要素を一番大きい値とする
    $max_number = $numbers[0];
    foreach($numbers as $num){
        if($max_number < $num){
            $max_number = $num;
        }
    }

    echo $max_number;
}
 
$test = array(4,3,5,6,7,8);
max_array($test);


 //----------------------------------------------------------------------------------
 //課題5
 //次のビルトイン関数の用途、使い方を調べて実際に使ってみてください。

//【strip_tags();】
//「strip_tags(文字列)」で指定した文字列からHTMLタグやPHPタグを取り除く。
$text = '<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>';
echo $text;                         //これだと<p>や<!-- -->や<a>もそのまま表示される。
echo strip_tags($text);             //strip_tags()を使うとHTMLタグは表示されなくなる。
echo "\n";                          //「\n」は改行を意味する文字列。""で囲まないと使えない。
// <p> は許可
echo strip_tags($text, '<p>');      //「,」の後にタグを指定するとそのタグだけは文字列としてそのまま表示される。

//【array_push();】
//「array_push(配列名,要素1,要素2,...)」で指定した配列の末尾に指定した要素を追加することができる。
//追加したい要素が複数ある場合に使うとよい。
$fruits = array('バナナ','リンゴ','ブドウ');
array_push($fruits,'キウイ','マンゴー');
print_r($fruits);                   //「print_r()」関数で配列の中身をわかりやすく表示できる。


//【array_merge();】
//「array_merge(対象の配列,追加したい配列1,追加したい配列2,...)」で配列同士をつなげることができる。
$drink = array('オレンジ','グレープ');
$fruitsDrink=array_merge($fruits,$drink);
print_r($fruitsDrink);


//【time();,mktime();】
//どちらも協定世界時（UTC）での1970年1月1日（午前0時0分0秒）からの経過時間を取得する関数。
//「time();」で現在時刻までの経過時間を取得できる。
echo '現在のUnixタイムスタンプ：'.time();      //現在のタイムスタンプを取得
echo"\n";
$nweek = time() + (3 * 24 * 60 * 60);          //3日後のタイムスタンプを取得
echo '3日後のUnixタイムスタンプ：'.$nweek;

//「mktime(時,分,秒,月,日,年);」で指定した日時までの経過時間を取得できる。
$timestamp = mktime(0, 0, 0, 11, 16, 1995);    //1995年11月16日までの経過時間を取得
echo $timestamp."\n";


//【date();】
//「date(任意の表示形式,タイムスタンプ);」で日時を好きな表示形式で表示できる。
//第二引数を指定しない場合は現在時刻を表示できる。
date_default_timezone_set('Asia/Tokyo');

echo date("Y/m/d H:i:s") . "\n";           //現在時刻
echo date("Y/m/01") . "\n";                //日付だけ指定
echo date("Y/m/t") . "\n";                 //tはその月の日数

$w = date("w");                            //wは曜日の番号（日[0]～土[6]）
$week_name = array("日", "月", "火", "水", "木", "金", "土");

echo date("Y/m/d") . "($week_name[$w])\n"; //上で定義した曜日の配列のインデックス番号にw(曜日の番号)を指定することで今日の曜日を表示できる。



?>