<?php

$user = 'root';
$pass = '';

try {

    $pdo = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    $stmt = $pdo -> prepare("INSERT INTO title (title) VALUES (:title)");

    $title = '';
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->execute();

    $id = $pdo->lastInsertId('id');

    $data = array('id'=>$id);
    echo json_encode($data);

    $pdo = null;
} catch (PDOException $e) {
    print "エラー!: " . $e->getMessage() . "<br/>";
    die();
}


?>