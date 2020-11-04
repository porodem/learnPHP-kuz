<?php
//phpinfo();
setcookie('counter', counter());

echo 'Описание задачи 14.5 : <br>Создайте скрипт, который бы складировал в файл ips.txt уникальные IР-адреса посетителей.<br> 
Для каждого из IР-адресов следует сохранять количество посеще­ний.<br>
Таким образом, при первом посещении в файле ips.txt появляется новая<br>
запись, а при последующих посещениях увеличивается счетчик этой записи.<br>- - -<br>';

$filename = 'res/ips.txt';
$coinsidence = false; //flag if word from text form equals any string in file

echo "(cookie counter value): {$_COOKIE['counter']} times<br>";

function counter() {
	if(isset($_COOKIE['counter'])) {
		$_COOKIE['counter']++;
	} else {
		$_COOKIE['counter'] = 1;
	}
	return $_COOKIE['counter'];
}

//Chapter 14 test 5
if(isset($_POST['tx'])) {
		if(!empty($_POST['tx'])) {
		$wasTryToWrite = true;
		$file_reading_result = file_get_contents($filename);
		$txt_size = strlen($file_reading_result) ;
		if(strlen($file_reading_result) > 1) {
			$endline = strpos($file_reading_result, "\n");
			echo 'POST send. Lenght of file content: '. $txt_size . ' end line: '. $endline . '<br>';
			$start = 0;	
			$char_coursor = 0;	
			$line_coursor = 1;
			
			while (is_int($char_coursor) /*< $txt_size*/) 
				{
				$line = substr($file_reading_result, $start, $endline);
				echo  $line . ' - ' . $start .'/'.  $endline.  ' char_coursor:' . $char_coursor 
					//show ip of user
					. ' , IP:' . $_SERVER['REMOTE_ADDR'] 
					//check if input value equal to line in file
					. ($line == $_POST['tx']?'<- line already exists':'') .'<br>';
				$start = $start + $endline +1; //+1 for jump over end of line (\n), if we start it will be infinite loop bcz char_coursor evrytime find it on same position
				$char_coursor = strpos($file_reading_result, "\n", $start); //on end of string returns nothing (todo: check type) use it to stop loop
				$endline = $char_coursor - $start;
				$line_coursor++;
				if($line==$_POST['tx']) $coinsidence = true;
		}
			
			//$char_coursor = $endline + strpos($file_reading_result, "\n", $start);
		}
		if(!$coinsidence & !empty($_POST['tx'])) {
			$updated_string = $file_reading_result . $_POST['tx'] . "\n";
			echo '<br> <b>result of updating string in file: </b>' . $updated_string . 'strlen of prev line:' . strlen($file_reading_result) . '<br>';
			$writing_result = file_put_contents('res/ips.txt', $updated_string);
			if($writing_result) {
				echo 'writing to file finished: succes!';
			} else {
				echo 'fail write';
			}
		}
	}
} else {
	echo '<b>$_POST contains:</b> ';
	print_r($_POST);
}

unset($_POST);
echo '<b>end of script: $_POST contains:</b> ';
	print_r($_POST);
//print_r($_ENV);
?>
<form method="post">
	<input type="text" name="tx">
	<input type="submit" name="send" value="Send">
</form>