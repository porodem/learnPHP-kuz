<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>HTML-form</title>
</head>
<body>
	<?php
	$errors  = [];
	if(!empty($_POST)) {
		if(empty($_POST['first'])) {
			$errors[] = 'text field not filled';
		}

		if(empty($errors)) {
			//echo htmlspecialchars($_POST['first']);
			//print_r($_POST);
			$writing_result = file_put_contents('res/output.txt', $_POST['bigtxt']);
			if($writing_result) {
				echo 'succes write';
			} else {
				echo 'fail write';
			}
			exit();
		}
	} 
	if (!empty($errors)) {
		foreach ($errors as $err) {
			echo "<span style=\"color:red\">$err</span><br>";
		}
	}
	?>
	<form method="post">
		<input type="hidden" name="hidden" value="<?= intval($_GET['id']); ?> ">
		<input type="text" name="first" 
			value="<?= htmlspecialchars($_POST['first'], ENT_QUOTES); ?>"><br>
		<textarea name="bigtxt" cols="50" rows="10"></textarea>
		<input type="submit" name="send">
	</form>

</body>
</html> 