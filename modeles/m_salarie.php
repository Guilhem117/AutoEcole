<?php

//C
function creerSalarie($surnom, $nom, $prenom, $adresse, $ville, $code, $telephone, $fonction, $email, $motdepasse) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT SEQ_SALARIE_IDSALARIE.NEXTVAL AS ID_UTILISE FROM DUAL');
	$req->execute();
	$idUtilise = $req->fetchColumn(0);
	
	$req = $cnx->prepare("INSERT INTO SALARIE (IDSALARIE,
										SURNOM, 
										NOM, 
										PRENOM, 
										ADRESSE, 
										VILLE, 
										CODE, 
										TELEPHONE, 
										FONCTION,
										EMAIL, 
										MOTDEPASSE)
						VALUES (:id_utilise, 
							   :surnom, 
							   :nom, 
							   :prenom, 
							   :adresse, 
							   :ville, 
							   :code, 
							   :telephone, 
							   :fonction, 
							   :email, 
							   :motdepasse)");
						   
							   
	$req->bindParam(':id_utilise', $idUtilise, PDO::PARAM_INT);
	$req->bindParam(':surnom', $surnom, PDO::PARAM_STR);
	$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	$req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	$req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
	$req->bindParam(':ville', $ville, PDO::PARAM_STR);
	$req->bindParam(':code', $code, PDO::PARAM_STR);
	$req->bindParam(':telephone', $telephone, PDO::PARAM_STR);
	$req->bindParam(':fonction', $fonction, PDO::PARAM_STR);
	$req->bindParam(':email', $email, PDO::PARAM_STR);
	$req->bindParam(':motdepasse', $motdepasse, PDO::PARAM_STR);
	
	$req->execute();
	
	return $idUtilise;
}

//R
function getSalaries() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDSALARIE, SURNOM FROM salarie
						  ORDER BY SURNOM');
                   
	$req->execute();
	$salaries = $req->fetchAll();
	
	return $salaries;
}

//R
function getSalarie($id) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDSALARIE, 
								 SURNOM,
								 NOM, 
								 PRENOM, 
								 ADRESSE, 
								 VILLE, 
								 CODE, 
								 FONCTION,
								 TELEPHONE,
								 EMAIL, 
								 MOTDEPASSE
						  FROM salarie
                          WHERE IDSALARIE = :id');

    $req->bindParam(':id', $id, PDO::PARAM_INT);               
	
	$req->execute();
	$salarie = $req->fetch(PDO::FETCH_ASSOC);
	return $salarie;

}

//U
function modifierSalarie($surnom, $id, $nom, $prenom, $adresse, $ville, $code, $telephone, $fonction, $email, $motdepasse) {
    global $cnx;
	
	$req = $cnx->prepare("UPDATE SALARIE 
                            SET NOM = :nom, 
								PRENOM = :prenom,
								ADRESSE = :adresse, 
								VILLE = :ville, 
								CODE = :code, 
								TELEPHONE = :telephone,  
								FONCTION = :fonction, 
								EMAIL = :email, 
								MOTDEPASSE = :motdepasse,
								SURNOM = :surnom 
							WHERE IDSALARIE = :id");

	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->bindParam(':surnom', $surnom, PDO::PARAM_STR);
	$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	$req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	$req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
	$req->bindParam(':ville', $ville, PDO::PARAM_STR);
	$req->bindParam(':code', $code, PDO::PARAM_STR);
	$req->bindParam(':telephone', $telephone, PDO::PARAM_STR);
	$req->bindParam(':fonction', $fonction, PDO::PARAM_STR);
	$req->bindParam(':email', $email, PDO::PARAM_STR);
	$req->bindParam(':motdepasse', $motdepasse, PDO::PARAM_STR);

	//print_r($req);
	$req->execute();
}

//D - Suppression des contraintes d'intégrité 
// Comportement similaire au "on delete cascade"
function supprimerSalarie($id) {

	//Test de la présence du salarié dans la table ELEVE
	global $cnx;
	
	$req = $cnx->prepare('SELECT * FROM ELEVE
							WHERE IDSALARIE = :id');

	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();

	$dependance = $req->fetchAll();

	if (count($dependance) != 0) {
		return "Impossible de supprimer le salarié " . $id . " car des élèves lui sont associés";
	}

	//Test de la présence du salarié dans la table VEHICULE
	$req = $cnx->prepare('SELECT * FROM VEHICULE
							WHERE IDSALARIE = :id');

	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();

	$dependance = $req->fetchAll();

	if (count($dependance) != 0) {
		return "Impossible de supprimer le  salarié " . $id . " car des vehicules lui sont associés";
	}

	
	//Test de la présence du salarié dans la table LECON_CONDUITE
	$req = $cnx->prepare('SELECT * FROM LECON_CONDUITE
							WHERE IDSALARIE = :id');

	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();

	$dependance = $req->fetchAll();

	if (count($dependance) != 0) {
		return "Impossible de supprimer le  salarié " . $id . " car des lecons de conduite lui sont associés";
	}


	//Suppression du salarie de la table SALARIE
	$req = $cnx->prepare('DELETE FROM SALARIE
							WHERE IDSALARIE = :id');

	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();

	return "Salarié " . $id . " supprimé";

}

/* Permet d'afficher la liste des formules
 * Return
 * 		Tableau associtatif contenant les nom et descriptions des formules
 */  
function getFormules()
{
  global $cnx;

  $req = $cnx->prepare('SELECT IDFORMULE, NOM FROM FORMULE');
	$req->execute();
	$listeFormule = $req->fetchAll();   	 

	return $listeFormule;    
}

?>