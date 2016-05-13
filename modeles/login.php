<?php

function getLogin($mail, $mdp) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT * FROM SALARIE WHERE EMAIL = :email AND MOTDEPASSE = :motdepasse');
	$req->bindParam(':email', $mail);
	$req->bindParam(':motdepasse', $mdp);
	$req->execute();
	$login = $req->fetchColumn();
	
	return $login;
}