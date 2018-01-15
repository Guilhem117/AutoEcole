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

require_once('modeles/m_vehicule.php');
require_once('inc/fonctions_diverses.php');

switch ($action) {
	case 'lister':
		$vehicules = getVehicules();
		require_once('vues/v_vehicule.lister.php');
		break;

	case 'creer':
		// on récupère les salariés
		$salaries = getSalaries();
		$immatriculation = '';
		$marque = '';
		$modele = '';
		$numero = '';
		$idSalarie = '';
		$message = '';
		
		// si le formulaire est validé
		if (isset($_POST['soumission'])) {
			$immatriculation = $_POST['immatriculation'];
			$marque = $_POST['marque'];
			$modele = $_POST['modele'];
			$numero = $_POST['numero'];
			$idSalarie = $_POST['salarie'];
			
			if ($immatriculation == '' or $marque == '' or $modele == '' or $numero == '' or $idSalarie == '') {
				$message = 'Tous les champs doivent être renseignés.';
			} else {
				// le numéro de véhicule doit être un entier strictement supérieur à 0
				if (ctype_digit($numero) and $numero > 0) {		
					// le numéro doit être disponible
					$verif_dispo_numero = verifDispoNumeroVehicule($numero);
					
					if (empty($verif_dispo_numero)) {
						creerVehicule($numero, $immatriculation, $marque, $modele, $idSalarie);
						header('location:main.php?rubrique=vehicule&action=lister');
					} else {
						$message = 'Le numéro de véhicule saisi est déjà utilisé.';
					}
				} else {
					$message = 'Le numéro de véhicule doit être un entier strictement supérieur à 0.';
				}
			}
		}
		
		require_once('vues/v_vehicule.creer.php');
		break;
		
	case 'editer':
		$immatriculation = '';
		$marque = '';
		$modele = '';
		$idSalarie = '';
		$message = '';
		// récupération des salariés
		$salaries = getSalaries();
		
		// si le formulaire est validé
		if (isset($_POST['soumission'])) {
			$immatriculation = $_POST['immatriculation'];
			$marque = $_POST['marque'];
			$modele = $_POST['modele'];
			$idSalarie = $_POST['salarie'];
			
			
			if ($immatriculation == '' or $marque == '' or $modele == '' or $idSalarie == '') {
				$message = 'Tous les champs doivent être renseignés.';
			} else {
				modifierVehicule($_GET['id'], $immatriculation, $marque, $modele, $idSalarie);
				header('location:main.php?rubrique=vehicule&action=lister');
			}
		} else {
			// lors du premier affichage, on récupère les données du véhicule
			
			$vehicule = getVehicule($_GET['id']);
			$immatriculation = $vehicule['IMMATRICULATION'];
			$marque = $vehicule['MARQUE'];
			$modele = $vehicule['MODELE'];
			$idSalarie = $vehicule['IDSALARIE'];
		}
		
		require_once('vues/v_vehicule.editer.php');
		break;
	case 'supprimer':
	
		// pour supprimer un véhicule, il ne doit pas être rattaché à des leçons
		$lecons = verifVehiculeRattacheALecons($_GET['id']);
		
		if (empty($lecons)) {
			supprimerVehicule($_GET['id']);
		} else {
			$_SESSION['messagePersistant'] = 'Impossible de supprimer le véhicule numéro '.$_GET['id'].' : il est rattaché à une ou plusieurs leçons de conduite.';
		}
	
		header('location:main.php?rubrique=vehicule&action=lister');
		break;
		
	case 'lister_releves':
		$releves = getRelevesVehicule($_GET['id']);
		require_once('vues/v_vehicule.lister_releves.php');
		break;
		
	case 'creer_releve':
		$date = '';
		$kilometrage = '';
		$message = '';
		
		// si le formulaire a été validé
		if (isset($_POST['soumission'])) {
			$date = $_POST['date'];
			$kilometrage = $_POST['kilometrage'];
			
			if ($date == '' or $kilometrage == '') {
				$message = 'Tous les champs doivent être renseignés.';
			} else {
				// contrôle de validité de la date de relevé
				if (validateDate($date) and (ctype_digit($kilometrage) and $kilometrage >= 0)) {
					creerReleve($_GET['id'], $date, $kilometrage);
					header('location:main.php?rubrique=vehicule&action=lister_releves&id='.$_GET['id']);
				} else {
					if (!validateDate($date)) {
						$message = 'La valeur saisie dans le champ "Date" est incorrecte. ';
					}
					
					// le kilométrage saisi doit être un entier strictement supérieur à 0
					if (!(ctype_digit($kilometrage) and $kilometrage >= 0)) {
						$message .= 'La valeur saisie dans le champ "Kilométrage" doit être un entier supérieur ou égal à 0.';
					}
				}
			}
		}
		
		require_once('vues/v_vehicule.creer_releve.php');
		break;
		
	case 'editer_releve':
		$date = '';
		$kilometrage = '';
		$message = '';
		
		// si le formulaire a été validé
		if (isset($_POST['soumission'])) {
			$date = $_POST['date'];
			$kilometrage = $_POST['kilometrage'];
			
			if ($date == '' or $kilometrage == '') {
				$message = 'Tous les champs doivent être renseignés.';
			} else {
				// vérification du format de la date et du kilométrage
				if (validateDate($date) and (ctype_digit($kilometrage) and $kilometrage >= 0)) {
					editerReleve($_GET['id'], $date, $kilometrage, $_GET['idReleve']);
					header('location:main.php?rubrique=vehicule&action=lister_releves&id='.$_GET['id']);
				} else {
					if (!validateDate($date)) {
						$message = 'La valeur saisie dans le champ "Date" est incorrecte. ';
					}
					
					if (!(ctype_digit($kilometrage) and $kilometrage >= 0)) {
						$message .= 'La valeur saisie dans le champ "Kilométrage" doit être un entier supérieur ou égal à 0.';
					}
				}
			}
		} else {
			// lors du premier affichage, on récupère les données du relevé
			
			$releve = getReleve($_GET['idReleve']);
			$date = $releve['DATERELEVE'];
			$kilometrage = $releve['KILOMETRAGE'];
		}
		
		require_once('vues/v_vehicule.editer_releve.php');
		break;
		
	case 'supprimer_releve':
		supprimerReleve($_GET['idReleve']);
		header('location:main.php?rubrique=vehicule&action=lister_releves&id='.$_GET['id']);
		break;
}