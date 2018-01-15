<?php

// connexion nécessaire pour accéder à cette rubrique
if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

require_once('modeles/m_responsable.php');

// définition d'une action par défaut si non spécifiée
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'lister';
}



if ($action == 'lister') 
{
	$responsables = getResponsables();
	require_once('vues/v_responsable.lister.php');
	
} else if ($action == 'creer') 
{	
	$nom               = '';
	$prenom            = '';
	$adresse           = '';
	$ville             = '';
	$codePostal        = '';
	$telephoneDomicile = '';
	$telephonePortable = '';
	
	
	// si le formulaire a été validé
	if (isset($_POST['soumission']))
	{     
		$nom               = $_POST['nom'];
		$prenom            = $_POST['prenom'];
		$adresse           = $_POST['adresse'];
		$ville             = $_POST['ville'];
		$codePostal        = $_POST['codePostal'];
		$telephoneDomicile = $_POST['telephoneDomicile'];
		$telephonePortable = $_POST['telephonePortable'];

		if ($nom == '' OR $prenom == '' OR $adresse == '' OR $ville == '' OR $codePostal == '' OR $telephoneDomicile == '' OR $telephonePortable == '') 
		{
			$message = 'Tous les champs doivent être renseignés.';
			require_once('vues/v_responsable.creer.php');
		} 
		else 
		{
			ajouterResponsable($nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable); 
			header('location:main.php?rubrique=responsable&action=lister');	
		}
	} 
	else 
	{
		require_once('vues/v_responsable.creer.php');
	}
	
} else if ($action == 'supprimer') 
{
	// pour supprimer un responsable ...
	
	
	/// ... il ne faut pas que des élèves y soit rattaché
	$eleves = checkElevesResponsable($_GET['id']);
	
	
	if (empty($eleves)) {
		supprimerResponsable($_GET['id']);
	} else {
		$_SESSION['messagePersistant'] = 'Impossible de supprimer ce responsable : il est rattaché à un ou plusieurs élèves.';
	}
	
	
	header('location:main.php?rubrique=responsable&action=lister');
} else if ($action == 'editer') 
{	
	$nom               = '';
	$prenom            = '';
	$adresse           = '';
	$ville             = '';
	$codePostal        = '';
	$telephoneDomicile = '';
	$telephonePortable = '';
	
	
	// si le formulaire est validé
	if (isset($_POST['soumission']))
	{     
		$nom               = $_POST['nom'];
		$prenom            = $_POST['prenom'];
		$adresse           = $_POST['adresse'];
		$ville             = $_POST['ville'];
		$codePostal        = $_POST['codePostal'];
		$telephoneDomicile = $_POST['telephoneDomicile'];
		$telephonePortable = $_POST['telephonePortable'];

		if ($nom == '' OR $prenom == '' OR $adresse == '' OR $ville == '' OR $codePostal == '' OR $telephoneDomicile == '' OR $telephonePortable == '') 
		{
			$message = 'Tous les champs doivent être renseignés.';
			require_once('vues/v_responsable.editer.php');
		} 
		else 
		{
			editerResponsable($_GET['id'], $nom, $prenom, $adresse, $ville, $codePostal, $telephoneDomicile, $telephonePortable); 
			header('location:main.php?rubrique=responsable&action=lister');	
		}
	} 
	else 
	{
		// si c'est le premier affichage, on récupère les données du responsable
		
		$responsable = getResponsable($_GET['id']);
		
		$nom               = $responsable['NOM'];
		$prenom            = $responsable['PRENOM'];
		$adresse           = $responsable['ADRESSE'];
		$ville             = $responsable['VILLE'];
		$codePostal        = $responsable['CODEPOSTAL'];
		$telephoneDomicile = $responsable['TELEPHONEDOMICILE'];
		$telephonePortable = $responsable['TELEPHONEPORTABLE'];
		
		require_once('vues/v_responsable.editer.php');
	}
	
}
