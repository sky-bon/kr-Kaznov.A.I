<?php include 'authentication-cookie.php'?>
<?php
$db_host = "127.0.0.1";
$db_name = "rostok";
$username = "root";
$password = "";
$db = new PDO("mysql:host=$db_host;dbname=$db_name;",$username,$password);
?>
