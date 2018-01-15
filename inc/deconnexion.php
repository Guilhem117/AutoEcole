<?php

	session_start();

	if (isset($_SESSION['mail'])) {
		unset($_SESSION['mail']);
		session_destroy();
	}
	
	header('location:../main.php?rubrique=index');
	
?>