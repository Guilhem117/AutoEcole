<?php


// récupère tous les responsables
function getResponsables()
{
  global $cnx;

  $req = $cnx->prepare('SELECT IDRESPONSABLE, NOM, PRENOM FROM RESPONSABLE ORDER BY NOM');
 	$req->execute();
 	$responsables = $req->fetchAll();   	 
  
 	return $responsables;    
}


// ajoute un nouveau responsable
function ajouterResponsable($nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable) 
{
  global $cnx;
  
  $req = $cnx->prepare('INSERT INTO RESPONSABLE VALUES (null, :nom, :prenom, :adresse, :ville, :codePostal, :telephoneDomicile, :telephonePortable)');             
  $req->bindparam(':nom', $nom, PDO::PARAM_STR);
  $req->bindparam(':prenom', $prenom, PDO::PARAM_STR);
  $req->bindparam(':adresse', $adresse, PDO::PARAM_STR);
  $req->bindparam(':ville', $ville, PDO::PARAM_STR);
  $req->bindparam(':codePostal', $codePostal, PDO::PARAM_STR);
  $req->bindparam(':telephoneDomicile', $telephoneDomicile, PDO::PARAM_STR);
  $req->bindparam(':telephonePortable', $telephonePortable, PDO::PARAM_STR);
  $req->execute();
}


// vérifie si un responsable est associé à un ou plusieurs élèves
function checkElevesResponsable($id) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT *
							FROM ELEVE
							WHERE IDRESPONSABLE = :id');
	$req->bindParam(':id', $id, PDO::PARAM_INT); 
	$req->execute();
	$eleves = $req->fetchAll();
	
	return $eleves;
} 


// supprime un responsable à partir de son id
function supprimerResponsable($id)
{
  global $cnx;

  $req = $cnx->prepare('DELETE FROM RESPONSABLE WHERE IDRESPONSABLE = :id');
  $req->bindParam(':id', $id, PDO::PARAM_INT); 
  $req->execute();
}

// récupère les infos d'un responsable à partir de son id
function getResponsable($id)
{
  global $cnx;

  $req = $cnx->prepare('SELECT IDRESPONSABLE, NOM, PRENOM, ADRESSE, VILLE, CODEPOSTAL, TELEPHONEDOMICILE, TELEPHONEPORTABLE FROM RESPONSABLE WHERE IDRESPONSABLE = :id');
  $req->bindparam(':id', $id);
  $req->execute();
  $responsable = $req->fetch(PDO::FETCH_ASSOC);	 
  
  return $responsable;
}


// met à jour les informations d'un responsable
function editerResponsable($id, $nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable)
{
  global $cnx;

  $req = $cnx->prepare('UPDATE RESPONSABLE 
						SET NOM = :nom,
						PRENOM = :prenom,
						ADRESSE = :adresse,
						VILLE = :ville,
						CODEPOSTAL = :codePostal,
						TELEPHONEDOMICILE = :telephoneDomicile,
                        TELEPHONEPORTABLE = :telephonePortable
                        WHERE IDRESPONSABLE = :id');
              
  $req->bindparam(':id', $id, PDO::PARAM_INT);              
  $req->bindparam(':nom', $nom, PDO::PARAM_STR);
  $req->bindparam(':prenom', $prenom, PDO::PARAM_STR);
  $req->bindparam(':adresse', $adresse, PDO::PARAM_STR);
  $req->bindparam(':ville', $ville, PDO::PARAM_STR);
  $req->bindparam(':codePostal', $codePostal, PDO::PARAM_STR);
  $req->bindparam(':telephoneDomicile', $telephoneDomicile, PDO::PARAM_STR);
  $req->bindparam(':telephonePortable', $telephonePortable, PDO::PARAM_STR);
  $req->execute();
}