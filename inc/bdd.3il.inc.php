<?php

$utilisateur = 'ING1324';
$motdepasse = 'ING1324';
$lien_base = "oci:dbname=BD10;charset=UTF8";

try {
	$cnx = new PDO($lien_base, $utilisateur, $motdepasse);
} catch (PDOException $e) {
	echo $e->getMessage();
}