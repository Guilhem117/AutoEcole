<?php

/* Permet de recuperer la liste des éléves
 *
 * Return
 * 		Tableau associtatif contenant le nom et le prénom des éléves
 */
function getEleves()
{
  global $cnx;

  $req = $cnx->prepare('SELECT IDELEVE, NOM, PRENOM FROM ELEVE ORDER BY NOM');
 	$req->execute();
 	$listeEleve = $req->fetchAll();   	 
  
 	return $listeEleve;    
}

/* Permet de recuperer toutes les informations d'un éléve précis
 * Param
 * 		 idEleve
 * Return
 * 		Tableau associtatif contenant le nom, prenom, adresse, codePostal, ville, ..., de l'éléve
 */  
function getEleve($idEleve)
{
  global $cnx;

  $req = $cnx->prepare('SELECT IDELEVE, NOM, PRENOM, ADRESSE, VILLE, CODEPOSTAL, TELEPHONEDOMICILE, TELEPHONEPORTABLE, LIEUETUDETRAVAIL, CODEPOSTALTRAVAIL, VILLETRAVAIL, IDFORMULE, IDRESPONSABLE, IDSALARIE, TO_CHAR(DATENAISSANCE, \'DD/MM/YYYY HH24:MI:SS\') AS DATENAISSANCE FROM ELEVE WHERE IDELEVE = :idEleve');
  $req->bindparam(':idEleve', $idEleve);
  $req->execute();
  $eleve = $req->fetch(PDO::FETCH_ASSOC);	 
  
  return $eleve;
}


function getFormules() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDFORMULE, NOM FROM FORMULE');
	$req->execute();
	$formules = $req->fetchAll();
	
	return $formules;
}

function getResponsables() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDRESPONSABLE, NOM, PRENOM FROM RESPONSABLE');
	$req->execute();
	$responsables = $req->fetchAll();
	
	return $responsables;
}

function getMoniteurs() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDSALARIE, SURNOM
							FROM SALARIE
							WHERE FONCTION=\'moniteur\'');
	$req->execute();
	$moniteurs = $req->fetchAll();
	
	return $moniteurs;
}

/* Permet d'ajouter un éléve
 * Param
 * 		 idEleve, nom, prenom, adresse, ville, codePostal, telephoneDomicile, telephoneProtable,  
 * 		 lieuEtude, codePostalTravail, villeTravail, idFormule, idResponsable, idSalarie
 * Return
 * 		Message de confirmation
 */  
function ajouterEleve($nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable, 
                        $lieuEtude, $codePostalTravail, $villeTravail, $idFormule, $idResponsable, $idSalarie, $dateNaissance) 
{
  global $cnx;

  
  $req = $cnx->prepare('INSERT INTO ELEVE VALUES (null, :nom, :prenom, :adresse, :ville, :codePostal, :telephoneDomicile,
  :telephonePortable, :lieuEtudeTravail, :codePostalTravail, :villeTravail, :idFormule, '.$idResponsable.', :idSalarie,
  TO_DATE(\''.$dateNaissance.'\', \'DD/MM/YYYY HH24:MI:SS\'))');             
  $req->bindparam(':nom', $nom, PDO::PARAM_STR);
  $req->bindparam(':prenom', $prenom, PDO::PARAM_STR);
  $req->bindparam(':adresse', $adresse, PDO::PARAM_STR);
  $req->bindparam(':ville', $ville, PDO::PARAM_STR);
  $req->bindparam(':codePostal', $codePostal, PDO::PARAM_STR);
  $req->bindparam(':telephoneDomicile', $telephoneDomicile, PDO::PARAM_STR);
  $req->bindparam(':telephonePortable', $telephonePortable, PDO::PARAM_STR);
  $req->bindparam(':lieuEtudeTravail', $lieuEtude, PDO::PARAM_STR);
  $req->bindparam(':codePostalTravail', $codePostalTravail, PDO::PARAM_STR);
  $req->bindparam(':villeTravail', $villeTravail, PDO::PARAM_STR);
  $req->bindparam(':idFormule', $idFormule, PDO::PARAM_INT);
  $req->bindparam(':idSalarie', $idSalarie, PDO::PARAM_INT);
  $req->execute();
}
  
 /* Permet de modifier un éléve
 * Param
 * 		 idEleve, nom, prenom, adresse, ville, codePostal, telephoneDomicile, telephoneProtable,  
 * 		 lieuEtude, codePostalTravail, villeTravail, idFormule, idResponsable, idSalarie
 * Return
 * 		Message de confirmation
 */  
function modifierEleve($idEleve, $nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable, 
                        $lieuEtude, $codePostalTravail, $villeTravail, $idFormule, $idResponsable, $idSalarie, $dateNaissance) 
{
  global $cnx;

  $req = $cnx->prepare('UPDATE ELEVE 
						SET NOM = :nom,
						PRENOM = :prenom,
						ADRESSE = :adresse,
						VILLE = :ville,
						CODEPOSTAL = :codePostal,
						TELEPHONEDOMICILE = :telephoneDomicile,
                        TELEPHONEPORTABLE = :telephonePortable,
						LIEUETUDETRAVAIL = :lieuEtudeTravail,
						CODEPOSTALTRAVAIL = :codePostalTravail,
						VILLETRAVAIL = :villeTravail, 
                        IDFORMULE = :idFormule,
						IDRESPONSABLE = '.$idResponsable.',
						IDSALARIE = :idSalarie,
						DATENAISSANCE = TO_DATE(\''.$dateNaissance.'\', \'DD/MM/YYYY HH24:MI:SS\')
                        WHERE IDELEVE = :idEleve');
              
  $req->bindparam(':idEleve', $idEleve, PDO::PARAM_INT);              
  $req->bindparam(':nom', $nom, PDO::PARAM_STR);
  $req->bindparam(':prenom', $prenom, PDO::PARAM_STR);
  $req->bindparam(':adresse', $adresse, PDO::PARAM_STR);
  $req->bindparam(':ville', $ville, PDO::PARAM_STR);
  $req->bindparam(':codePostal', $codePostal, PDO::PARAM_STR);
  $req->bindparam(':telephoneDomicile', $telephoneDomicile, PDO::PARAM_STR);
  $req->bindparam(':telephonePortable', $telephonePortable, PDO::PARAM_STR);
  $req->bindparam(':lieuEtudeTravail', $lieuEtude, PDO::PARAM_STR);
  $req->bindparam(':codePostalTravail', $codePostalTravail, PDO::PARAM_STR);
  $req->bindparam(':villeTravail', $villeTravail, PDO::PARAM_STR);
  $req->bindparam(':idFormule', $idFormule, PDO::PARAM_INT);
  $req->bindparam(':idSalarie', $idSalarie, PDO::PARAM_INT);
  $req->execute();
}

/* Permet de supprimer un éléve
 * Param
 * 		 idEleve 
 * Return
 * 		Message de confirmation
 */  
function supprimerEleve($idEleve)
{
  global $cnx;

  $req = $cnx->prepare('DELETE FROM ELEVE WHERE IDELEVE = :idEleve');
  $req->bindParam(':idEleve', $idEleve, PDO::PARAM_INT); 
  $req->execute();
}

function checkLeconsEleve($idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT *
							FROM LECON_CONDUITE
							WHERE IDELEVE = :idEleve');
	$req->bindParam(':idEleve', $idEleve, PDO::PARAM_INT); 
	$req->execute();
	$lecons = $req->fetchAll();
	
	return $lecons;
}
 
 
function checkAchatsEleve($idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT *
							FROM ACHAT_TICKET
							WHERE IDELEVE = :idEleve');
	$req->bindParam(':idEleve', $idEleve, PDO::PARAM_INT); 
	$req->execute();
	$tickets = $req->fetchAll();
	
	return $tickets;
} 

function checkExamensEleve($idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT *
							FROM PASSAGE_EXAMEN
							WHERE IDELEVE = :idEleve');
	$req->bindParam(':idEleve', $idEleve, PDO::PARAM_INT); 
	$req->execute();
	$examens = $req->fetchAll();
	
	return $examens;
} 
 
 
?>