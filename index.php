<?php
	$myfile = fopen("index.html", "r");
	$real = array();
	while(!feof($myfile)) {
		echo fgets($myfile);
	}

	fclose($myfile);
?>