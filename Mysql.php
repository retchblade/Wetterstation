<?php
$host = "79.252.182.224";
$name = "werkzeugvermietung";
$user = "Lorenz";
$passwort = "lorenz";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>