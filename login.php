<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	if ($_SESSION["admin"] == true) {
		ob_start();
		header('Location: admin.php');
		ob_end_flush();
		die();
	}


	if (isset($_POST["username"]) && isset($_POST["userpw"])) {
		$name = $_POST["username"];
		$userpw = $_POST["userpw"];

		$myfile = fopen("config.txt", "r");
		$real = array();
		while(!feof($myfile)) {
			$line = fgets($myfile);
			$key = explode(":", $line)[0];
			$value = substr($line, strpos($line, ":") + 1);
			$value = trim($value, "\n");
			$real[$key] = $value;
		}

		fclose($myfile);


		$realname = $real["username"];
		$realpw = $real["password"];

		if ($realname == $name && $realpw == $userpw) {
			$_SESSION["admin"] = true;
			ob_start();
			header('Location: admin.php');
			ob_end_flush();
		} else {
			echo "yanlış şifre";
			$_SESSION["admin"] = false;
		}
	}
?>
<form action="" method="POST">
	<input type="text" name="username" placeholder="Kullanıcı adı"/>
	<input type="text" name="userpw" placehodler="Şifre"/>
	<button>send</button>
</form>
