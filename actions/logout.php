<?php 
require_once('../vendor/autoload.php');  
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

include "../db/db_conn.php";  

$sessionStorage = new NativeSessionStorage([], new PdoSessionHandler($conn));
$session = new Session($sessionStorage);

$session->start();
$session->clear();

header("Location: ../index.php");