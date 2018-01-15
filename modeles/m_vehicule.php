<?php


// récupère les salariés
function getSalaries() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDSALARIE, NOM, PRENOM
							FROM SALARIE
							ORDER BY NOM');
	$req->execute();
	$salaries = $req->fetchAll();
	
	return $salaries;
}


// récupère tous les véhicules
function getVehicules() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT NUMVEHICULE, IMMATRICULATION, MARQUE, MODELE, IDSALARIE
							FROM VEHICULE
							ORDER BY NUMVEHICULE');
	$req->execute();
	$vehicules = $req->fetchAll();
	
	return $vehicules;
}

// récupère les infos d'un véhicule à partir de son numéro
function getVehicule($numero) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IMMATRICULATION, MARQUE, MODELE, IDSALARIE
							FROM VEHICULE
							WHERE NUMVEHICULE = :numero');
	
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->execute();
	$vehicule = $req->fetch(PDO::FETCH_ASSOC);

	return $vehicule;
}


// vérifie si un numéro de véhicule est disponible
function verifDispoNumeroVehicule($numero) {
	global $cnx;

	$req = $cnx->prepare('SELECT NUMVEHICULE
							FROM VEHICULE
							WHERE NUMVEHICULE = :numero');
							
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->execute();
	$vehicules = $req->fetchAll();

	return $vehicules;
}


// ajoute un nouveau véhicule
function creerVehicule($numero, $immatriculation, $marque, $modele, $idSalarie) {
	global $cnx;
	
	$req = $cnx->prepare('INSERT INTO VEHICULE
							VALUES(:numero, :immatriculation, :marque, :modele, :id_salarie)');
	
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
	$req->bindParam(':marque', $marque, PDO::PARAM_STR);
	$req->bindParam(':modele', $modele, PDO::PARAM_STR);
	$req->bindParam(':id_salarie', $idSalarie, PDO::PARAM_INT);
	$req->execute();
}


// met à jour les informations d'un véhicule
function modifierVehicule($numero, $immatriculation, $marque, $modele, $idSalarie) {
	global $cnx;
	
	$req = $cnx->prepare('UPDATE VEHICULE
							SET IMMATRICULATION = :immatriculation,
							MARQUE = :marque,
							MODELE = :modele,
							IDSALARIE = :id_salarie
							WHERE NUMVEHICULE = :numero');
	
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
	$req->bindParam(':marque', $marque, PDO::PARAM_STR);
	$req->bindParam(':modele', $modele, PDO::PARAM_STR);
	$req->bindParam(':id_salarie', $idSalarie, PDO::PARAM_INT);
	$req->execute();
}


// supprime un véhicule à partir de son numéro
function supprimerVehicule($numero) {
	global $cnx;
	
	$req = $cnx->prepare('DELETE FROM VEHICULE WHERE NUMVEHICULE = :numero');
	
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->execute();
}

// récupère les relevés kilométriques d'un véhicule à partir de son numéro
function getRelevesVehicule($numero) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDRELEVE, TO_CHAR(DATERELEVE, \'DD/MM/YYYY HH24:MI:SS\') AS DATERELEVE, KILOMETRAGE
							FROM RELEVE_COMPTEUR
							WHERE NUMVEHICULE = :numero
							ORDER BY IDRELEVE DESC');
							
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->execute();
	$releves = $req->fetchAll();
	
	return $releves;
}


// ajoute un relevé kilométrique à un véhicule
function creerReleve($numero, $date, $kilometrage) {
	global $cnx;
	
	$req = $cnx->prepare('INSERT INTO RELEVE_COMPTEUR
							VALUES(null, TO_DATE(\''.$date.'\', \'DD/MM/YYYY HH24:MI:SS\'), :kilometrage, :numero)');
	
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->bindParam(':kilometrage', $kilometrage, PDO::PARAM_STR);
	$req->execute();
}


// édite un relevé kilométrique d'un véhicule
function editerReleve($numero, $date, $kilometrage, $idReleve) {
	global $cnx;
	
	$req = $cnx->prepare('UPDATE RELEVE_COMPTEUR
							SET DATERELEVE = TO_DATE(\''.$date.'\', \'DD/MM/YYYY HH24:MI:SS\'),
							KILOMETRAGE = :kilometrage,
							NUMVEHICULE = :numero
							WHERE IDRELEVE = :id_releve');
	
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->bindParam(':id_releve', $idReleve, PDO::PARAM_INT);
	$req->bindParam(':kilometrage', $kilometrage, PDO::PARAM_STR);
	$req->execute();
}


// supprime un relevé kilométrique à partir de son numéro
function supprimerReleve($idReleve) {
	global $cnx;
	
	$req = $cnx->prepare('DELETE FROM RELEVE_COMPTEUR WHERE IDRELEVE = :id_releve');
	
	$req->bindParam(':id_releve', $idReleve, PDO::PARAM_INT);
	$req->execute();
}


// récupère les infos d'un relevé à partir de son id
function getReleve($idReleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT TO_CHAR(DATERELEVE, \'DD/MM/YYYY HH24:MI:SS\') AS DATERELEVE, KILOMETRAGE, NUMVEHICULE
							FROM RELEVE_COMPTEUR
							WHERE IDRELEVE = :id_releve');
	
	$req->bindParam(':id_releve', $idReleve, PDO::PARAM_INT);
	$req->execute();
	$releve = $req->fetch(PDO::FETCH_ASSOC);

	return $releve;
}


// vérifie si un véhicule est rattaché à des leçons de conduites
function verifVehiculeRattacheALecons($numero) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT NUMVEHICULE
							FROM LECON_CONDUITE
							WHERE NUMVEHICULE = :numero');
							
	$req->bindParam(':numero', $numero, PDO::PARAM_INT);
	$req->execute();
	$lecons = $req->fetchAll();
	
	return $lecons;
}