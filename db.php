<?php
$driver = 'mysql';
$host = 'localhost';
$db_name = '10lessons';
$db_user = '10lessons';
$db_password = '10lessons';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

$dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";
try
{
   
    $pdo = new PDO($dsn, $db_user, $db_password, $options);
}
catch(PDOException $e) {
    $db_error = $e->getMessage();
}


?>