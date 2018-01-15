<?php

// connexion nécessaire pour accéder à cette rubrique
if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

// définition d'une action par défaut si non spécifiée
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'lister';
}

require_once('modeles/m_examen.php');
require_once('inc/fonctions_diverses.php');


switch ($action) {
	case 'lister':
		// récupération de la liste de tous les examens
		$examens = getExamens();
		require_once('vues/v_examen.lister.php');
		break;
		
		
		
	case 'creer':
		$date    = '';
		$type    = '';
		$message = '';
		
		
		// si le formulaire a été validé
		if (isset($_POST['soumission'])) {
			$date = $_POST['date'];
			$type = $_POST['type'];
			
			if ($date == '') {
				$message = 'Le champ "Date" doit être renseigné.';
			} else {
				// contrôle de la validité de la date
				if (validateDate($date)) {
					creerExamen($date, $type);
					header('location:main.php?rubrique=examen&action=lister');
				} else {
					$message = 'La valeur saisie dans le champ "Date" est incorrecte.';
				}
			}
		}
		
		require_once('vues/v_examen.creer.php');
		break;
		
		
		
	case 'supprimer':
		supprimerExamen($_GET['id']);
		header('location:main.php?rubrique=examen&action=lister');
		break;
		
		
		
	case 'editer':
		$date = '';
		$type = '';
		
		
		// si le formulaire a été validé
		if (isset($_POST['soumission'])) {
			$date = $_POST['date'];
			$type = $_POST['type'];
			
			if ($date == '') {
				$message = 'Le champ "Date" doit être renseigné.';
			} else {
				// contrôle de la validité de la date
				if (validateDate($date)) {
					modifierExamen($_GET['id'], $date, $type);
					header('location:main.php?rubrique=examen&action=lister');
				} else {
					$message = 'La valeur saisie dans le champ "Date" est incorrecte.';
				}
			}
		} else {
			// au premier affichage, on récupère les données de l'examen
			$examen = getExamen($_GET['id']);
			
			$date = $examen['DATEEXAM'];
			$type = $examen['TYPEEXAM'];
		}
		
		require_once('vues/v_examen.editer.php');
		
		break;
		
		
		
	case 'lister_editer_participants':
	
		// si le formulaire est validé
		if (isset($_POST['soumission'])) {
			// on modifie le statut de passage pour chacun des inscrits
			foreach($_SESSION['id_inscrits'] as $id_inscrit) {
				modifierStatutPassageExamenEleve($_GET['id'], $id_inscrit, $_POST['statut'.$id_inscrit]);
			}
			
			$message = 'Les statuts ont bien étés modifiés';
		}
		
		$examen = getExamen($_GET['id']);
		$inscrits = getInscritsAExamen($_GET['id']);
		
		$_SESSION['id_inscrits'] = array();
		unset($_SESSION['id_inscrits']);
		
		$i = 0;
		
		// on stocke tous les ids des incrits dans un tableau de session
		foreach($inscrits as $inscrit) {
			$_SESSION['id_inscrits'][$i] = $inscrit['IDELEVE'];
			$i++;
		}
		
		require_once('vues/v_examen.lister_editer_participants.php');
		break;
		
	case 'ajouter_participant':
		
		// si le formulaire est validé
		if (isset($_POST['soumission'])) {
			$eleve = getEleve($_POST['participant']);
			$examen = getExamen($_GET['id']);
			
			// si l'examen de de type "conduite"
			if ($examen['TYPEEXAM'] == 'conduite') {
				// l'élève doit avoir au moins 18 ans
				if ($eleve['AGE'] < 18) {
					$message = 'Impossible d\'ajouter l\'élève '.strtoupper($eleve['NOM']).' '.$eleve['PRENOM'].' à cet examen : il n\'a pas encore 18 ans.';
				} else {
					$dernierPassageCodeEleve = getDernierPassageCodeEleve($_POST['participant']);
					
					// l'élève doit être titulaire du code depuis moins de 2 ans
					if (($dernierPassageCodeEleve['AGE'] < 2) && ($dernierPassageCodeEleve['STATUTEXAM'] == 'réussi')) {
						inscrireEleveAExamen($_GET['id'], $_POST['participant']);
						$message = 'L\'élève '.strtoupper($eleve['NOM']).' '.$eleve['PRENOM'].' a bien été ajouté à cet examen.';
					} else {
						$message = 'Impossible d\'ajouter l\'élève '.strtoupper($eleve['NOM']).' '.$eleve['PRENOM'].' à cet examen : il n\'est pas en possession du code depuis moins de 2 ans.';
					}
				}
			} else {
				if ($eleve['AGE'] < 16) {
					$message = 'Impossible d\'ajouter l\'élève '.strtoupper($eleve['NOM']).' '.$eleve['PRENOM'].' à cet examen : il n\'a pas encore 16 ans.';
				} else {
					inscrireEleveAExamen($_GET['id'], $_POST['participant']);
					$message = 'L\'élève '.strtoupper($eleve['NOM']).' '.$eleve['PRENOM'].' a bien été ajouté à cet examen.';
				}
			}
		}
		
		// on récupère les non-inscrits pour les proposer en ajout
		$non_inscrits = getNonInscritsAExamen($_GET['id']);
		require_once('vues/v_examen.ajouter_participant.php');
		break;
		
		
		
	case 'supprimer_participant':
		desinscrireEleveAExamen($_GET['idExamen'], $_GET['idEleve']);
		header('location:main.php?rubrique=examen&action=lister_editer_participants&id='.$_GET['idExamen']);
		break;
}