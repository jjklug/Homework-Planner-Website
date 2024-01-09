<?php
$databaseName = 'JJKLUG_labs';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = 'jjklug_writer';
$password = 'SiuFPZIH1u8h';

$pdo = new PDO($dsn, $username, $password);
?>