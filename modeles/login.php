<?php

function verifLogin($mail, $mdp) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT * FROM SALARIE WHERE EMAIL = :mail AND MOTDEPASSE = :mdp');
	$req->bindParam(':mail', $mail, PDO::PARAM_STR);
	$req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
	$req->execute();
	$count = $req->fetchColumn();
	
	return $count;
}