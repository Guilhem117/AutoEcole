<?php

$utilisateur = 'XXX';
$motdepasse = 'XXX';
$lien_base = "oci:dbname=XXX;charset=UTF8";

try {
	$cnx = new PDO($lien_base, $utilisateur, $motdepasse);
} catch (PDOException $e) {
	echo $e->getMessage();
}