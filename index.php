<?php
	error_reporting(E_ALL ^ E_NOTICE);

	$myfile = fopen("index.html", "r");
	$real = array();
	while(!feof($myfile)) {
		echo fgets($myfile);
	}

	fclose($myfile);
?>