<?php
require('functions.php');
try {
  $pdo = new PDO(
    "mysql:host=".$host.";dbname=".$db,
    $uname, $pword, [
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
  );
} catch (Exception $ex) { exit($ex->getMessage()); }
$stmt = $pdo->prepare("SELECT * FROM `help` WHERE `name` LIKE ?");
$stmt->execute(["%".$_GET['search']."%"]);
$results = $stmt->fetchAll();
