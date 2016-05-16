<?php

function getLeconsDuJour() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT LC.IDLECON, TO_CHAR(LC.DATELECON, \'DD/MM/YYYY HH24:MI:SS\') AS "DATELECON", LC.STATUTLECON, E.NOM AS "NOMELEVE", E.PRENOM AS "PRENOMELEVE", S.NOM AS "NOMSALARIE", S.PRENOM AS "PRENOMSALARIE", LC.NUMVEHICULE
							FROM LECON_CONDUITE LC, ELEVE E, SALARIE S
							WHERE LC.IDSALARIE = S.IDSALARIE
							AND LC.IDELEVE = E.IDELEVE
							AND TRUNC(LC.DATELECON) = TRUNC(SYSDATE)
							ORDER BY LC.DATELECON');
	$req->execute();
	$lecons = $req->fetchAll();
	
	return $lecons;
}

function getLeconsFiltrage($dateDebut, $dateFin, $statut, $idEleve, $idSalarie, $numVehicule) {
	global $cnx;
	
	$chaine_req = 'SELECT LC.IDLECON, TO_CHAR(LC.DATELECON, \'DD/MM/YYYY HH24:MI:SS\') AS "DATELECON", LC.STATUTLECON, E.NOM AS "NOMELEVE", E.PRENOM AS "PRENOMELEVE", S.NOM AS "NOMSALARIE", S.PRENOM AS "PRENOMSALARIE", LC.NUMVEHICULE
							FROM LECON_CONDUITE LC, ELEVE E, SALARIE S
							WHERE LC.IDSALARIE = S.IDSALARIE
							AND LC.IDELEVE = E.IDELEVE';
	
	if ($dateDebut != '' and $dateFin != '') {
		$chaine_req = $chaine_req.' AND LC.DATELECON >= TO_DATE(\''.$dateDebut.'\', \'DD/MM/YYYY HH24:MI:SS\')'.' AND LC.DATELECON <= TO_DATE(\''.$dateFin.'\', \'DD/MM/YYYY HH24:MI:SS\')';
	}
	
	if ($statut != '*') {
		$chaine_req = $chaine_req.' AND LC.STATUTLECON = \''.$statut.'\'';
	}
	
	if ($idEleve != '*') {
		$chaine_req = $chaine_req.' AND E.IDELEVE = '.$idEleve;
	}
	
	if ($idSalarie != '*') {
		$chaine_req = $chaine_req.' AND S.IDSALARIE = '.$idSalarie;
	}
	
	if ($numVehicule != '*') {
		$chaine_req = $chaine_req.' AND LC.NUMVEHICULE = '.$numVehicule;
	}
	
	$chaine_req = $chaine_req.' ORDER BY LC.DATELECON';
	
	$req = $cnx->prepare($chaine_req);
	$req->execute();
	$lecons = $req->fetchAll();
	
	return $lecons;
}

function getMoniteurs() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDSALARIE, NOM, PRENOM
							FROM SALARIE
							WHERE FONCTION = \'moniteur\'');
	$req->execute();
	$moniteurs = $req->fetchAll();
	
	return $moniteurs;
}

function getEleves() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDELEVE, NOM, PRENOM
							FROM ELEVE');
	$req->execute();
	$eleves = $req->fetchAll();
	
	return $eleves;
}

function getVehicules() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT NUMVEHICULE
							FROM VEHICULE');
	$req->execute();
	$vehicules = $req->fetchAll();
	
	return $vehicules;
}