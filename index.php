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

if (is_null($id) && is_null($user_name)) {

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
     <form action="actions/login.php" method="post">
     	<h2>LOGIN</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Email</label>
     	<input type="username" name="username" placeholder="Username"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"><br>
		<div class="form-group">
			<label>Keep me logged in</label>
			<input name="flag" type="checkbox" style="width:10%; margin:0; margin-rigth:15px">
		</div>
     	<button type="submit">Login</button>
     </form>
</body>
</html>
<?php 
}else{
     header("Location: home.php");
     exit();
}
 ?>