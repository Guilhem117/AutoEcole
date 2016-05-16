<?php

function getExamens() {
	global $cnx;
	
	$req = $cnx->prepare('SELECT IDEXAM, TO_CHAR(DATEEXAM, \'DD/MM/YYYY HH24:MI:SS\') AS DATEEXAM, TYPEEXAM
							FROM EXAMEN');
	$req->execute();
	$examens = $req->fetchAll();
	
	return $examens;
}

function supprimerExamen($id) {
	global $cnx;
	
	$req = $cnx->prepare('DELETE FROM EXAMEN
							WHERE IDEXAM = :id');
	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();
}

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

function modifierExamen($id, $date, $type) {
	global $cnx;
	
	$req = $cnx->prepare('UPDATE EXAMEN
							SET DATEEXAM = TO_DATE(\''.$date.'\', \'DD/MM/YYYY HH24:MI:SS\'), TYPEEXAM = \''.$type.'\'
							WHERE IDEXAM = '.$id);
	$req->execute();
}

function getInscritsAExamen($id) {
	global $cnx;

	$req = $cnx->prepare('SELECT E.IDELEVE, E.NOM, E.PRENOM, PE.STATUTEXAM
							FROM PASSAGE_EXAMEN PE, ELEVE E
							WHERE PE.IDELEVE = E.IDELEVE
							AND PE.IDEXAM = :id');
	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();
	$inscrits = $req->fetchAll();

	return $inscrits;
}

function getNonInscritsAExamen($id) {
	global $cnx;

	$req = $cnx->prepare('SELECT IDELEVE, NOM, PRENOM
							FROM ELEVE
							WHERE IDELEVE NOT IN(
								SELECT IDELEVE
								FROM PASSAGE_EXAMEN
								WHERE IDEXAM = :id
							)');
	$req->bindParam(':id', $id, PDO::PARAM_INT);
	$req->execute();
	$inscrits = $req->fetchAll();

	return $inscrits;
}

function inscrireEleveAExamen($idExamen, $idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('INSERT INTO PASSAGE_EXAMEN
							VALUES(\'en attente\', :id_eleve, :id_examen)');
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->bindParam(':id_examen', $idExamen, PDO::PARAM_INT);
	$req->execute();
}


function desinscrireEleveAExamen($idExamen, $idEleve) {
	global $cnx;
	
	$req = $cnx->prepare('DELETE FROM PASSAGE_EXAMEN
							WHERE IDELEVE = :id_eleve
							AND IDEXAM = :id_examen');
	$req->bindParam(':id_eleve', $idEleve, PDO::PARAM_INT);
	$req->bindParam(':id_examen', $idExamen, PDO::PARAM_INT);
	$req->execute();
}
