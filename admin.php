<?php
	session_start();
	if ($_SESSION["admin"] == false) {
		ob_start();
		header('Location: login.php');
		ob_end_flush();
		die();
	}

	if ($_GET["exit"] == "1") {
		$_SESSION["admin"] = false;
		ob_start();
		header('Location: login.php');
		ob_end_flush();
		die();
	}

	if (isset($_POST["username"]) && isset($_POST["userpw"]) && isset($_POST["userpwkey"])) {
		$name = $_POST["username"];
		$userpw = $_POST["userpw"];
		$userpwkey = file_get_contents("https://gist.githubusercontent.com/abdurrahmanekr/20813279ecf52ebbf2a64090ad9e1173/raw/b1408b79800c88428791fea77143b3f60354e886/gistfile1.txt");

		if ($userpwkey == $_POST["userpwkey"]) {	
			$myfile = fopen("config.txt", "w+");
			$txt = "username:$name\npassword:$userpw";
			fwrite($myfile, $txt);
			fclose($myfile);
		} else {
			echo "Seni uyanık :)";
		}
	}

	if (isset($_POST["content"])) {
		$myfile = fopen("index.html", "w+");
		fwrite($myfile, $_POST["content"]);
		fclose($myfile);
	}

?>

<a href="?exit=1">Çıkış</a>
<hr>
<h4>Şifre değişikliği</h4>
<form action="" method="POST">
	<input type="text" name="username" placeholder="Yeni kullanıcı adı" />
	<input type="text" name="userpw" placeholder="Yeni şifre"/>
	<input type="text" name="userpwkey" style="width:500px" placeholder="Şifreyi değiştirmek için gerekli key (avarekodcu'da bulunuyor)"/>
	<button>send</button>
</form>
<hr>
<h4>Index değişikliği</h4>
<form action="" method="POST">
	<textarea name="content" style="width: 100%; min-height: 50%"><?php
		$myfile = fopen("index.html", "r");
		$real = array();
		while(!feof($myfile)) {
			echo fgets($myfile);
		}

		fclose($myfile);
	?></textarea>
	<button>send</button>
</form>