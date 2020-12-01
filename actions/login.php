<?php 
require_once('../vendor/autoload.php');
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

include "../db/db_conn.php";  
include "../helpers.php";

$sessionStorage = new NativeSessionStorage([], new PdoSessionHandler($conn));
$session = new Session($sessionStorage);
$session->start();

$request = Request::createFromGlobals();
$username_post = $request->request->get('username');
$password_post = $request->request->get('password');
$keep_logged = $request->request->get('flag');

if ($username_post && $password_post) {

	$username = validate($username_post);
	$pass = validate($password_post);

	if (empty($username)) {
		header("Location: ../index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: ../index.php?error=Password is required");
	    exit();
	}else{
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? AND password = ?");

        $stmt->execute(array($username, $pass));
		$result = $stmt->fetchAll();
		
		if (count($result) === 1) {
			$row = $result[0];
            if ($row['user_name'] === $username && $row['password']) {
                if($pass && !is_null($keep_logged)){
					$session->set('user_name', $row['user_name']);
					$session->set('name', $row['name']);
					$session->set('id', $row['id']);
                }
            	header("Location: ../home.php");
		        exit();
            }else{
				header("Location: ../index.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: ../index.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
    header("Location: ../index.php");
    header("Location: ../index.php?error=User Name and Password are required");
	exit();
}