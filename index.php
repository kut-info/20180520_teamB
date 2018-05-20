<?php
	$user_name;
	$passwd;
/*
	$url = "test6.json";
	$json = file_get_contents($url);
 */
	$content_type = explode(';', trim(strtolower($_SERVER['CONTENT_TYPE'])));
	$media_type = $content_type[0];
	$requset = json_decode(file_get_contents('php://input'), true);
	try {
		$dsn = "mysql:dbname=test;host=localhost;charset=utf8mb4";
		$pdo = new PDO($dsn, $user_name, $passwd);
	} catch (PDOException $e){
		echo "error<br>";
		exit;
	}
	$id = $requset['id'];
	echo $id;
	if ($requset['action'] == "start") {
		$stmt = $pdo->query("insert into time (id) value('$id')");
	} else {
		$stmt = $pdo->query("update time set end=NOW() where id='$id' && start = end");
	}
?>
