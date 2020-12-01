<?php

$sname= "localhost";
$user= "";
$password = "";
$db_name = "challenge";
$conn = new PDO('mysql:dbname='.$db_name.';host='.$sname, $user, $password);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (!$conn) {
	echo "Connection failed!";
}