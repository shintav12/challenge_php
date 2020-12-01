<?php 
require_once('vendor/autoload.php'); 
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

include "db/db_conn.php";  

$sessionStorage = new NativeSessionStorage([], new PdoSessionHandler($conn));
$session = new Session($sessionStorage);

$session->start();
$id = $session->get('id');
$user_name = $session->get('user_name');

if (!is_null($id) && !is_null($user_name)) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
     <h1>Hello, <?php echo $session->get('name'); ?></h1>
     <a href="actions/logout.php">Logout</a>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>