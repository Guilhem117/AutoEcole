<?php


// récupère tous les élèves
function getEleves() {
	global $cnx;

	$req = $cnx->prepare('SELECT IDELEVE, NOM, PRENOM
							FROM ELEVE
							ORDER BY NOM');
	$req->execute();
	$eleves = $req->fetchAll();

	return $eleves;
	
}


// récupère les achats de tickets d'un élève à partir de son id
function getAchatsTicketsEleve($idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDACHAT, QUANTITE, TO_CHAR(DATEACHAT, \'DD/MM/YYYY HH24:MI:SS\') AS DATEACHAT, MOYENPAIEMENT
							FROM ACHAT_TICKET
							WHERE IDELEVE = :id_eleve');
	
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->execute();
	$achatsTickets = $req->fetchAll();

	return $achatsTickets;
}


// récupère les infos d'un élève à partir de son id
function getEleve($idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT NOM, PRENOM
							FROM ELEVE
							WHERE IDELEVE = :id_eleve');
	
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->execute();
	$eleve = $req->fetch(PDO::FETCH_ASSOC);

	return $eleve;
}


// récupère les infos d'un achat de tickets à partir de son id
function getAchatTicket($idAchat) {	
	global $cnx;
	
	$req = $cnx->prepare('SELECT QUANTITE, TO_CHAR(DATEACHAT, \'DD/MM/YYYY HH24:MI:SS\') AS DATEACHAT, MOYENPAIEMENT
							FROM ACHAT_TICKET
							WHERE IDACHAT = :id_achat');
	
	$req->bindParam(':id_achat', $idAchat, PDO::PARAM_INT);
	$req->execute();
	$achatTicket = $req->fetch(PDO::FETCH_ASSOC);

	return $achatTicket;
}


// crée un nouvel achat de ticket
function creerAchatTickets($date, $quantite, $moyenPaiement, $idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('INSERT INTO ACHAT_TICKET
							VALUES(null, '.$quantite.', TO_DATE(\''.$date.'\', \'DD/MM/YYYY HH24:MI:SS\'), \''.$moyenPaiement.'\', '.$idEleve.')');
	
	$req->execute();
}


// met à jour les infos d'un achat de tickets
function modifierAchatTickets($date, $quantite, $moyenPaiement, $idAchat) {
	global $cnx;
	
	$req = $cnx->prepare('UPDATE ACHAT_TICKET
							SET DATEACHAT = TO_DATE(\''.$date.'\', \'DD/MM/YYYY HH24:MI:SS\'), QUANTITE = '.$quantite.', MOYENPAIEMENT = \''.$moyenPaiement.'\'
							WHERE IDACHAT = '.$idAchat);
	$req->execute();
}


// supprime un achat de tickets à partir de son id
function supprimerAchatTickets($idAchat) {
	global $cnx;
	
	$req = $cnx->prepare('DELETE FROM ACHAT_TICKET
							WHERE IDACHAT = :id');
	$req->bindParam(':id', $idAchat, PDO::PARAM_INT);
	$req->execute();
}