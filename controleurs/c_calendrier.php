<?php

session_start();

if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}
	
require_once('modeles/m_calendrier.php');


$eleves = getEleves();
$moniteurs = getMoniteurs();
$vehicules = getVehicules();

if (isset($_POST['soumission'])) {
	$dateDebut   = $_POST['dateDebut'];
	$dateFin     = $_POST['dateFin'];
	$statut      = $_POST['statut'];
	$idEleve     = $_POST['eleve'];
	$idSalarie   = $_POST['salarie'];
	$numVehicule = $_POST['vehicule'];
	$titreResultat = 'Résultat de la recherche :';
	$lecons = getLeconsFiltrage($dateDebut, $dateFin, $statut, $idEleve, $idSalarie, $numVehicule);
} else {
	$message= '';
	$titreResultat = 'Leçons du jour :';
	$dateDebut   = '';
	$dateFin     = '';
	$statut      = '';
	$idEleve     = '';
	$idSalarie   = '';
	$numVehicule = '';
	$lecons = getLeconsDuJour();
}

require_once('vues/v_calendrier.php');