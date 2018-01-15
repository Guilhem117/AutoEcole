<?php

// connexion nécessaire pour accéder à cette rubrique
if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

require_once('modeles/m_formule.php');

// définition d'une action par défaut si non spécifiée
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'lister';
}


if ($action == 'lister') 
{
	$listeFormule = getFormules();
	require_once('vues/v_formule.lister.php');
	
} 
else if ($action == 'creer')
{	
	$nom                = '';
	$prix_inscription   = '';
	$nb_lecons_incluses = '';
	$prix_lecon         = '';
	$description        = '';
	
	
	// si le formulaire a été validé
	if (isset($_POST['soumission'])) 
	{
		$nom                = $_POST['nom'];
		$prix_inscription   = $_POST['prix_inscription'];
		$nb_lecons_incluses = $_POST['nb_lecons_incluses'];
		$prix_lecon         = $_POST['prix_lecon'];
		$description        = $_POST['description'];


		if ($nom == '' OR $prix_inscription == '' OR $nb_lecons_incluses == '' OR $prix_lecon == '' OR $description == '') 
		{
			$message = 'Tous les champs doivent être renseignés';
			require_once('vues/v_formule.creer.php');
		} 
		else 
		{
			ajouterFormule($idFormule="NULL", $nom, $prix_inscription, $nb_lecons_incluses, $prix_lecon, $description); 
			header('location:main.php?rubrique=formule&action=lister');
		}
	} 
	else 
	{
		require_once('vues/v_formule.creer.php');
	}
	
}
else if ($action == 'supprimer') 
{
	// pour supprimer une formule ...
	
	// ... il ne faut pas que des élèves y soit rattachés
	$eleves = verifFormuleRattacheAEleve($_GET['id']);
	
	if (empty($eleves)) {
		supprimerFormule($_GET['id']);
	} else {
		$_SESSION['messagePersistant'] = 'Impossible de supprimer cette formule : un ou plusieurs élèves y sont rattachés.';
	}
	
	
	header('location:main.php?rubrique=formule&action=lister');
} 
else if ($action == 'editer') 
{	
	$nom                = '';
	$prix_inscription   = '';
	$nb_lecons_incluses = '';
	$prix_lecon         = '';
	$description        = '';
	
	// si le formulaire a été validé
	if (isset($_POST['soumission'])) 
	{
		$nom                = $_POST['nom'];
		$prix_inscription   = $_POST['prix_inscription'];
		$nb_lecons_incluses = $_POST['nb_lecons_incluses'];
		$prix_lecon         = $_POST['prix_lecon'];
		$description        = $_POST['description'];


		if ($nom == '' OR $prix_inscription == '' OR $nb_lecons_incluses == '' OR $prix_lecon == '' OR $description == '') 
		{
			$message = 'Tous les champs doivent être renseignés';
			require_once('vues/v_formule.editer.php');
		} 
		else 
		{
			modifierFormule($_GET['id'], $nom, $prix_inscription, $nb_lecons_incluses, $prix_lecon, $description); 
			header('location:main.php?rubrique=formule&action=lister');
		}
	} 
	else 
	{
		// au premier affichage du formulaire, on récupère les données de la formule
		
		$formule = selectionFormule($_GET['id']);
		
		$nom                = $formule['NOM'];
		$prix_inscription   = $formule['PRIXINSCRIPTION'];
		$nb_lecons_incluses = $formule['NBLECONSINCLUSES'];
		$prix_lecon         = $formule['PRIXUNITAIRELECON'];
		$description        = $formule['DESCRIPTION'];
		
		require_once('vues/v_formule.editer.php');
	}
}
