<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Learning PHP Кузнецов</title>
	<meta charset='utf-8'>
</head>
<body>

<h3>Chapter 3 - first start - date, time, random</h3>
<?php 
echo 'php ver: ' . PHP_VERSION . '<br>';

error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'includes/constants.php';
require 'building.php';

echo "<br>Date <b>date('d-m-y')</b>: " . date('d-m-y') . '<br>';
$tstamp = time();
//var_dump($tstamp);
echo "Time <b>date('H:i:s',time())</b>: " . date('H:i:s',$tstamp); //get time from timestamp
echo '<br>Random <b>mt_rand()</b> fuction: '. mt_rand() . ' , <b>mt_rand(min,max)</b>: ' . mt_rand(1,9);
?>


<h3>Chapter 4 - variables and data types</h3><br>
<?php

//unset isset 										 - - - - 	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	

$gold = 100;
echo "\$gold value: $gold <br> - -> unset(\$gold)<br>";
unset($gold);
if(isset($gold)) {
echo " gold: $gold";
	} else { echo "\$gold value is null";}

$gold = 0;
echo "<br><b>\$gold = 0</b>; and check with function <b>empty(\$gold)</b><br> result: ";

//empty gettype

if(!empty($gold)) {
	echo "there is some gold ( $gold ). (gettype: " . gettype($gold) . ")<br>";
} else {
	echo "no gold ( $gold ) . (gettype: " . gettype($gold) . ")<br>";
}

$gold = 9.6;
echo '<b>round</b> $gold: ' .round($gold) . ' ceil: ' . ceil($gold) . ' floor: ' .floor($gold);
?>


<h3> Chapter 5 - Classes and objects </h3>
<p>class building example</p>

<?php //									- 	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	
$hut = new Building('hut');
$hut->build_hut();
//$hut->name = "хижина";
echo $hut->name;
echo ', static_var = ' . Building::$static_var;
?>


<h3> Chapter 6 - Constants </h3>
<p>show constant WOOD_HUT from /includes/constants.php</p>

<?php
echo $hut->name . ' requires ' . WOOD_HUT . ' единиц дерева<br>';
echo 'константа класса Building: ' . Building::ABOUT;
?>


<h3> Chapter 8 - Conditions </h3>

(condition?if_true:if_false)<br>
result:

<?PHP 											//	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-
echo $gold>100?'you are rich!':'you are poor';
$gold = null;
$gold = $gold ?? 5;  //assign value only if value is null
echo '<br> now gold value = ' . $gold . '<br>';

$file_b = file_get_contents('res/buildings.txt');
echo 'text from file, received with function <b>file_get_contents(\'res/buildings.txt\')</b>: ' . $file_b;

echo "<br>trying to write variable to file res/output.txt - ";
$writing_result = file_put_contents('res/output.txt', $gold);
if($writing_result) {
	echo 'succes write';
} else {
	echo 'fail write';
}

?>


<h3> Chapter 10 - Arrays </h3>

<?php  											//	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	
$player_buildings = array('хижина','хижина', 'сарай','загон');

echo 'array[0]: ' . $player_buildings[0] . '<br>';
echo '<pre>';
print_r($player_buildings);
echo '</pre>';

$instruments = [];
$instruments = ['топор','пила','дрель','молоток'];
echo '<br> 1-ый инструмент из инвентаря: ' . $instruments[0];

$city_param = ['money'=>120, 'population'=>9, 'knowlege'=>3];
echo '<pre>';
print_r($city_param);

echo '</pre> <b>foreach</b>(city_param as key => val): ';
foreach ($city_param as $key => $val) {
	echo "<br>$key = $val";
}

echo '<br> <b>foreach</b>(city_param as val): ';
foreach ($city_param as $key => $val) {
	echo "$val / ";
}
/*	Если в обоих складываемых массивах присутствуют элементы с одинаковыми
индексами, в результирующий массив попадают элементы из левого массива (лис­тинг 10.28)
	Для того чтобы в результирующий массив попали элементы обоих массивов,
вместо оператора + используют специальную функцию array_merge ()*/
echo '<br> <b>in_array()</b> : ';

if(in_array(120, $city_param)) {
	echo "120 found in array";
} else {
	echo 'money param dont exists';
}


echo '<br> <b>array_key_exists(money, $city_param)</b> : ';
if(array_key_exists('money', $city_param)) {
	echo "money: " . $city_param['money'];
}


$knowledge_val = array_search(3, $city_param);
echo "<br><br> key returned from <b>array_search(element_value, array_name)</b> function : $knowledge_val";


//build array from file
echo "<br><br>get array from file lines using function file(file_name) : ";

$seasons = file('res/seasons.txt');

print_r($seasons);

//try by myself array of objects
$hut2 = new Building('хижина');
$buildings_arr = [];
array_push($buildings_arr, $hut2);
echo '<br>obj in array: .' . $buildings_arr[0]->name;
?>


<h3> Chapter 11 - Functions </h3>
<br>
<!-- 									see file web/kuz/building.php 		-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-->

<?php 
$gold = 100;

function build_a_structure($structure_name) {
	echo "$structure_name is build";
}

build_a_structure('мельница');


echo '<br>';

function buy_a_structure(&$gold, $structure_name = 'лесопилка') { //&$ symbols to send parameter by link not value !
	$gold -=30;
	echo "$structure_name is build (price 30). Now you have ( $gold )";
}


 buy_a_structure($gold, 'farm');
 echo '<br>';
 buy_a_structure($gold);
 echo "<br>gold: $gold <br>";
?>

<h3> Chapter 12 - String Functions </h3>
<br>
<?php 										//	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	-	
//phpinfo(); //check where php.ini locate. to check than mbstring extensions is enabled
$str1 = 'Hello';
$strRu = 'Привет';
echo 'show [1] element from string \'Hello\' : ' . $str1[1]; //show 'e'
echo '<br>show [1] element from string \'Привет\' : ' . $strRu[1] . ' ; mb_strlen= ' .mb_strlen($strRu) . ' strlen= ' . strlen($strRu); //show ? if mbstring is not enabled
echo '<br><b>substr</b>(string, start) : ' . substr($str1, 1);
echo '<br><b>strpos</b>(str, str_to_find [, int $offset = 0]) = ' . strpos($str1, 'lo');
echo '<br><b>str_replace</b>(search, replace, str [, int &$count]) : ' . $str1 . ' -> ' .str_replace('o', '', $str1) 
		. '  <b>2)</b> using arrays in param [l,o], and count replaces ' . str_replace(['l','o'], ['y','z'], $str1, $rcount) . ' replaced char count: ' . $rcount . '<br />';

//замена перевода строк в HTML эквивалент
/*$str2 = <<<text 
hello
snake
text;*/
//echo nl2br($str2);
htmlspecialchars('<br>input from user');  //defence JS and PHP from dangerous input
//split strings

$str3 = 'Съедобно;100;нет';
echo '<br> explode() result: '; print_r( explode(';', $str3));

echo '<br> implode() function result : ';
print_r(implode(',', $player_buildings)); //create string from array of elements
?>
</body>
</html>