<?php
 
//***************************************************************************//
// Fonction de la classe formule                                             //
// Contient toutes les fonctions requetes sql lié au formule                 //
//***************************************************************************//

/* Permet d'afficher la liste des formules
 * Return
 * 		Tableau associtatif contenant les nom et descriptions des formules
 */  
function getFormules()
{
  global $cnx;

  $req = $cnx->prepare('SELECT IDFORMULE, NOM, DESCRIPTION FROM FORMULE');
 	$req->execute();
 	$listeFormule = $req->fetchAll();   	 
  
 	return $listeFormule;    
}

/* Permet de recuperer toutes les informations d'une formule précis
 * Param
 * 		 idFormule 
 * Return
 * 		Tableau associtatif contenant toutes les informations d'une formule
 */  
function selectionFormule($idFormule)
{
  global $cnx;

  $req = $cnx->prepare('SELECT * FROM FORMULE WHERE IDFORMULE= :idFormule');
  $req->bindparam(':idFormule', $idFormule, PDO::PARAM_INT);
  $req->execute();
 	$formule = $req->fetch(PDO::FETCH_ASSOC);	 
  
 	return $formule;  
}

/* Permet d'ajouter une formule
 * Param
 * 		 idFormule, nom, prixInscrip, nbrLeconInclu, prixUnitLecon, description 
 * Return
 * 		Message de confirmation
 */  
function ajouterFormule($idFormule, $nom, $prixInscrip, $nbrLeconInclu, $prixUnitLecon, $description) 
{
  global $cnx;

  	$req = $cnx->prepare('SELECT SEQ_SALARIE_IDSALARIE.NEXTVAL AS ID_UTILISE FROM DUAL');
	$req->execute();
	$idUtilise = $req->fetchColumn(0);
  

  $req = $cnx->prepare('INSERT INTO FORMULE VALUES( :idFormule , :nom , :prixInscrip , :nbrLeconInclu , :prixUnitLecon , :description )');

  $req->bindparam(':idFormule', $idUtilise, PDO::PARAM_INT);
  $req->bindparam(':nom', $nom, PDO::PARAM_STR);
  $req->bindparam(':prixInscrip', $prixInscrip, PDO::PARAM_INT);
  $req->bindparam(':nbrLeconInclu', $nbrLeconInclu, PDO::PARAM_INT);
  $req->bindparam(':prixUnitLecon', $prixUnitLecon, PDO::PARAM_INT);
  $req->bindparam(':description', $description, PDO::PARAM_STR);
  $req->execute();

}

function modifierFormule($idFormule, $nom, $prixInscrip, $nbrLeconInclu, $prixUnitLecon, $description)
{
	global $cnx;
	
	$req = $cnx->prepare('UPDATE FORMULE
							SET NOM = :nom,
							PRIXINSCRIPTION = :prix_inscription,
							NBLECONSINCLUSES = :nb_lecons_incluses,
							PRIXUNITAIRELECON = :prix_unitaire_lecon,
							DESCRIPTION = :description
							WHERE IDFORMULE = :id_formule');
							
	$req->bindparam(':id_formule', $idFormule, PDO::PARAM_INT);
	$req->bindparam(':nom', $nom, PDO::PARAM_STR);
	$req->bindparam(':prix_inscription', $prixInscrip, PDO::PARAM_INT);
	$req->bindparam(':nb_lecons_incluses', $nbrLeconInclu, PDO::PARAM_INT);
	$req->bindparam(':prix_unitaire_lecon', $prixUnitLecon, PDO::PARAM_INT);
	$req->bindparam(':description', $description, PDO::PARAM_STR);
	$req->execute();
}

/* Permet de supprimer une formule
 * Param
 * 		 idFormule 
 * Return
 * 		Message de confirmation
 */  
function supprimerFormule($idFormule)
{
  global $cnx;

  $req = $cnx->prepare('DELETE FROM FORMULE WHERE IDFORMULE=
  :idFormule');
  $req->bindparam(':idFormule', $idFormule, PDO::PARAM_INT);
  $req->execute();
}

function verifFormuleRattacheAEleve($id_formule) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDFORMULE
							FROM ELEVE
							WHERE IDFORMULE = :id_formule');
							
	$req->bindParam(':id_formule', $id_formule, PDO::PARAM_INT);
	$req->execute();
	$eleves = $req->fetchAll();
	
	return $eleves;
}


?>