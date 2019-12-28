<?php
    echo 'Hello,PHP!';
?>

<?php
//【PHP/Laravel 02 PHPの型と基本的な式を理解しよう】の課題

//課題１
//$a　という変数に3を、$b　という変数に７を代入して、echoを使って$a+$bの結果を表示してみましょう。
$a = 3;
$b = 7;
echo $a+$b;

//課題２
//$array_month という配列に1月〜12月の文字列を代入し、echoで8月を表示してみましょう。
$array_month = array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
echo $array_month[7];

//課題３
//$hello　という変数に　”Hello, “を $name という変数にあなたの名前を、　
//$world という変数に　”‘s World!” を代入して、各変数を連結させて “Hello, あなたの名前’s World!” と表示してみましょう。

$hello = 'Hello, ';
$name = 'KOSAKU';
$world = "'s world!";
echo $hello.$name.$world;

//課題４
//$tech_boostに “tech “という文字列が代入されています。複合演算を使って、echo $tech_boostと実行すると「tech boost」と表示されるように実装してみましょう。

$tech_boost = 'tech';
$tech_boost .= ' boost';
echo $tech_boost;

//課題５
//【応用】次のプログラムにはバグがあります。どこにバグが有るか調べて修正してみましょう。(バグは一つとは限りません。)

$calendar = array(          //数字始まりだった連想配列名を変更。「= {」を「= array(」に変更。
  'January' => '1月',
  'February' => '2月',      //点（、）をカンマ（,）に変更
  'March' => '3月',
  'April' => '4月',
  "May" => "5月",
  "June" => "6月",          //「=」の次に「>」を追加
  "July" => "7月",
  "August" => "8月",
  "September" => "9月",
  "October" => "10月",
  "November" => "11月",
  "December" => "12月"
);                          //「}」を「)」に変更
