<?php

// CONTROLEUR POUR LA RUBRIQUE "INDEX"

session_start();

if (isset($_SESSION['mail'])) {
	echo 'ok';
} else {
	echo 'nok';
}