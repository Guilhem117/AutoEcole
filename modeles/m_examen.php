<?php


// récupère tous les examens
function getExamens() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDEXAM, TO_CHAR(DATEEXAM, \'DD/MM/YYYY HH24:MI:SS\') AS DATEEXAM, TYPEEXAM
							FROM EXAMEN
							ORDER BY DATEEXAM ASC');
	$req->execute();
	$examens = $req->fetchAll();
	
	return $examens;
}


// supprime un examen à partir de son id
function supprimerExamen($id) {
	global $cnx;
	
	$req = $cnx->prepare('DELETE FROM EXAMEN
							WHERE IDEXAM = :id');
	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();
}


// récupère un examen à partir de son id
function getExamen($id) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDEXAM, TO_CHAR(DATEEXAM, \'DD/MM/YYYY HH24:MI:SS\') AS DATEEXAM, TYPEEXAM
							FROM EXAMEN
							WHERE IDEXAM = :id');
	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();
	$examen = $req->fetch(PDO::FETCH_ASSOC);
	
	return $examen;
}


// met à jour les infos d'un examen
function modifierExamen($id, $date, $type) {
	global $cnx;
	
	$req = $cnx->prepare('UPDATE EXAMEN
							SET DATEEXAM = TO_DATE(\''.$date.'\', \'DD/MM/YYYY HH24:MI:SS\'), TYPEEXAM = \''.$type.'\'
							WHERE IDEXAM = '.$id);
	$req->execute();
}


// récupére les élèves inscrits à un examen
function getInscritsAExamen($id) {
	global $cnx;

	$req = $cnx->prepare('SELECT E.IDELEVE, E.NOM, E.PRENOM, PE.STATUTEXAM
							FROM PASSAGE_EXAMEN PE, ELEVE E
							WHERE PE.IDELEVE = E.IDELEVE
							AND PE.IDEXAM = :id
							ORDER BY E.NOM');
	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();
	$inscrits = $req->fetchAll();

	return $inscrits;
}


// récupère les élèves non-inscrits à un examen
function getNonInscritsAExamen($id) {
	global $cnx;

	$req = $cnx->prepare('SELECT IDELEVE, NOM, PRENOM
							FROM ELEVE
							WHERE IDELEVE NOT IN(
								SELECT IDELEVE
								FROM PASSAGE_EXAMEN
								WHERE IDEXAM = :id
							)
							ORDER BY NOM');
	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();
	$inscrits = $req->fetchAll();

	return $inscrits;
}


// inscrit un élève à un examen
function inscrireEleveAExamen($idExamen, $idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('INSERT INTO PASSAGE_EXAMEN
							VALUES(\'en attente\', :id_eleve, :id_examen)');
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->bindParam(':id_examen', $idExamen, PDO::PARAM_INT);
	$req->execute();
}


// modifie le statut de passage d'un élève à un examen
function modifierStatutPassageExamenEleve($idExamen, $idEleve, $statut_exam) {
	global $cnx;
	
	$req = $cnx->prepare('UPDATE PASSAGE_EXAMEN
							SET STATUTEXAM = :statut_exam
							WHERE IDELEVE = :id_eleve
							AND IDEXAM = :id_examen');
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->bindParam(':id_examen', $idExamen, PDO::PARAM_INT);
	$req->bindParam(':statut_exam', $statut_exam, PDO::PARAM_STR);
	$req->execute();
}

// désinscrit un élève à un examen
function desinscrireEleveAExamen($idExamen, $idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('DELETE FROM PASSAGE_EXAMEN
							WHERE IDELEVE = :id_eleve
							AND IDEXAM = :id_examen');
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->bindParam(':id_examen', $idExamen, PDO::PARAM_INT);
	$req->execute();
}

// crée un nouvel examen
function creerExamen($date, $type) {
	global $cnx;
	
	$req = $cnx->prepare('INSERT INTO EXAMEN
							VALUES(null, TO_DATE(\''.$date.'\', \'DD/MM/YYYY HH24:MI:SS\'), \''.$type.'\')');
	
	$req->execute();
}

// récupère les infos d'un élève à partir de son id
function getEleve($idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT NOM, PRENOM, trunc(months_between(sysdate,DATENAISSANCE)/12) AS AGE
							FROM ELEVE
							WHERE IDELEVE = :id_eleve');
	
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->execute();
	$eleve = $req->fetch(PDO::FETCH_ASSOC);

	return $eleve;
}


// récupère le dernier passage à l'examen du code d'un élève, à partir de son id
function getDernierPassageCodeEleve($idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('SELECT E.IDEXAM, PE.STATUTEXAM, trunc(months_between(sysdate,E.DATEEXAM)/12) AS AGE
							FROM PASSAGE_EXAMEN PE, EXAMEN E
							WHERE PE.IDELEVE = :id_eleve
							AND PE.IDEXAM = E.IDEXAM
							AND E.TYPEEXAM = \'code\'
							AND E.DATEEXAM = ( SELECT MAX(E.DATEEXAM)
												FROM PASSAGE_EXAMEN PE, EXAMEN E
												WHERE PE.IDELEVE = :id_eleve
												AND PE.IDEXAM = E.IDEXAM
												AND E.TYPEEXAM = \'code\'
											 )');
	
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->execute();
	$dernierPassageCodeEleve = $req->fetch(PDO::FETCH_ASSOC);

	return $dernierPassageCodeEleve;
}