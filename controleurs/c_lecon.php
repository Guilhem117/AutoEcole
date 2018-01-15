<?php

// connexion nécessaire pour accéder à cette rubrique
if (!isset($_SESSION['mail'])) {
	header('location:main.php?rubrique=index');
}

require_once('modeles/m_lecon.php');
require_once('inc/fonctions_diverses.php');

// définition d'une action par défaut si non spécifiée
if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'lister';
}


switch ($action) {
	case 'lister':
		$eleves = getEleves();
		$moniteurs = getMoniteurs();
		$vehicules = getVehicules();
		$message = '';
		
		// si le formulaire a été validé
		if (isset($_POST['soumission'])) {
			$dateDebut   = $_POST['dateDebut'];
			$dateFin     = $_POST['dateFin'];
			$statut      = $_POST['statut'];
			$idEleve     = $_POST['eleve'];
			$idSalarie   = $_POST['salarie'];
			$numVehicule = $_POST['vehicule'];
			
			$titreResultat = 'Résultat de la recherche :';
			
			if (($dateDebut == '') or ($dateFin == '')) {
				$message = 'Tous les champs doivent être renseignés.';
			} else {
				// les dates de recherche doivent être valides ...
				// ... et la date de début plus ancienne que la date de fin
				if (validateDate($dateDebut) && validateDate($dateFin)
					&& (date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $dateDebut))) < date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $dateFin))))) {
					
					// on récupère les leçons conformes au critères de recherche
					$lecons = getLeconsFiltrage($dateDebut,
												$dateFin,
												$statut,
												$idEleve,
												$idSalarie,
												$numVehicule);
				} else {
					if (!validateDate($dateDebut)) {
						$message = 'La valeur saisie dans le champ "Date de début" est incorrecte. ';
					}
					
					if (!validateDate($dateFin)) {
						$message = 'La valeur saisie dans le champ "Date de fin" est incorrecte.';
					}
					
					if (($message == '') && (date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $dateDebut))) >= date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $dateFin))))) {
						$message = 'La date de début doit être strictement inférieure à la date de fin.';
					}
				}
			}
		} else {
			// par défaut on récupère les leçons du jour
			
			$dateDebut   = '';
			$dateFin     = '';
			$statut      = '';
			$idEleve     = '';
			$idSalarie   = '';
			$numVehicule = '';
			
			$titreResultat = 'Leçons du jour :';
			$lecons = getLeconsDuJour();
		}

		require_once('vues/v_lecon.lister.php');
		break;

	case 'supprimer':
		supprimerLecon($_GET['id']);
		header('location:main.php?rubrique=lecon&action=lister');
		break;
		
	case 'creer':
		$eleves = getEleves();
		$moniteurs = getMoniteurs();
		$vehicules = getVehicules();
		$date = '';
		$statut = '';
		$idEleve     = '';
		$idSalarie   = '';
		$numVehicule = '';
		$message = '';
		
		// si le formulaire a été validé
		if (isset($_POST['soumission'])) {
			$date        = $_POST['date'];
			$statut      = $_POST['statut'];
			$idEleve     = $_POST['eleve'];
			$idSalarie   = $_POST['moniteur'];
			$numVehicule = $_POST['vehicule'];
			
			if ($date == '') {
				$message= 'Tous les champs doivent être renseignés.';
			} else {
				// contrôle de la validité de la date
				if (validateDate($date)) {
				
					// on vérifie les disponibilités du moniteur, de l'élève et du véhicule
					$lecons_check1 = verifDispoDateLeconSalarie(-1, $date, $idSalarie);
					$lecons_check2 = verifDispoDateLeconEleve(-1, $date, $idEleve);
					$lecons_check3 = verifDispoDateLeconVehicule(-1, $date, $numVehicule);
					
					// on vérifie que la leçon respecte les horaires d'ouverture de l'AE
					$d1 = DateTime::createFromFormat('d/m/Y H:i:s', $date);
					
					$d2 = clone $d1;
					$d2->setTime(7, 0, 0);
					
					$d3 = clone $d1;
					$d3->setTime(19, 0, 0);
					
					$eleve = getAgeEleve($idEleve);
				
					if (empty($lecons_check1) && empty($lecons_check2) && empty($lecons_check3) && ($d1->format('D') != 'Sun' && $d1 >= $d2 && $d1 <= $d3)
						&& $eleve['AGE'] >= 16) {
						ajouterLecon($date, $statut, $idSalarie, $idEleve, $numVehicule);
						header('location:main.php?rubrique=lecon&action=lister');
					} else {				
						if (!empty($lecons_check1)) {
							$message = 'Le moniteur sélectionné n\'est pas disponible à cette date. ';
						}
						
						if (!empty($lecons_check2)) {
							$message .= 'L\'élève sélectionné n\'est pas disponible à cette date. ';
						}
						
						if (!empty($lecons_check3)) {
							$message .= 'Le véhicule sélectionné n\'est pas disponible à cette date. ';
						}
						
						if (!($d1->format('D') != 'Sun' && $d1 >= $d2 && $d1 <= $d3)) {
							$message .= 'Les leçons doivent avoir lieu du lundi au samedi, entre 7 heures et 20 heures. ';
						}
						
						if ($eleve['AGE'] < 16) {
							$message .= 'L\'élève doit avoir 16 ans révolus. ';
						}
						
					}
					
				} else {
					$message = 'La valeur saisie dans le champ "Date" est incorrecte.';
				}
			}
		}
		
	
		require_once('vues/v_lecon.creer.php');
		
		break;
		
		
	case 'editer':
		
		$eleves = getEleves();
		$moniteurs = getMoniteurs();
		$vehicules = getVehicules();
		$message = '';
		
		// si le formulaire a été validé
		if (isset($_POST['soumission'])) {
			$date        = $_POST['date'];
			$statut      = $_POST['statut'];
			$idEleve     = $_POST['eleve'];
			$idSalarie   = $_POST['moniteur'];
			$numVehicule = $_POST['vehicule'];
			
			if ($date == '') {
				$message= 'Tous les champs doivent être renseignés.';
			} else {
				// contrôle de la validité de la date
				if (validateDate($date)) {
				
					// vérif des diponibilités du moniteur, de l'élève et du véhicule
					$lecons_check1 = verifDispoDateLeconSalarie($_GET['id'], $date, $idSalarie);
					$lecons_check2 = verifDispoDateLeconEleve($_GET['id'], $date, $idEleve);
					$lecons_check3 = verifDispoDateLeconVehicule($_GET['id'], $date, $numVehicule);
					
					// on vérifie que la leçon respecte les horaires d'ouverture de l'AE
					$d1 = DateTime::createFromFormat('d/m/Y H:i:s', $date);
					
					$d2 = clone $d1;
					$d2->setTime(7, 0, 0);
					
					$d3 = clone $d1;
					$d3->setTime(19, 0, 0);
					
					$eleve = getAgeEleve($idEleve);
				
					if (empty($lecons_check1) && empty($lecons_check2) && empty($lecons_check3) && ($d1->format('D') != 'Sun' && $d1 >= $d2 && $d1 <= $d3)
						&& $eleve['AGE'] >= 16) {
						modifierLecon($_GET['id'], $date, $statut, $idSalarie, $idEleve, $numVehicule);
						header('location:main.php?rubrique=lecon&action=lister');
					} else {				
						if (!empty($lecons_check1)) {
							$message = 'Le moniteur sélectionné n\'est pas disponible à cette date. ';
						}
						
						if (!empty($lecons_check2)) {
							$message .= 'L\'élève sélectionné n\'est pas disponible à cette date. ';
						}
						
						if (!empty($lecons_check3)) {
							$message .= 'Le véhicule sélectionné n\'est pas disponible à cette date. ';
						}
						
						if (!($d1->format('D') != 'Sun' && $d1 >= $d2 && $d1 <= $d3)) {
							$message .= 'Les leçons doivent avoir lieu du lundi au samedi, entre 7 heures et 20 heures.';
						}
						
						if ($eleve['AGE'] < 16) {
							$message .= 'L\'élève doit avoir 16 ans révolus. ';
						}
						
					}
					
				} else {
					$message = 'La valeur saisie dans le champ "Date" est incorrecte.';
				}
			}
		} else {
			// lors du premier affichage, on récupère les données de la leçon
			
			$lecon       = getLecon($_GET['id']);
			$date        = $lecon['DATELECON'];
			$statut      = $lecon['STATUTLECON'];
			$idEleve     = $lecon['IDELEVE'];
			$idSalarie   = $lecon['IDSALARIE'];
			$numVehicule = $lecon['NUMVEHICULE'];
		}
		
	
		require_once('vues/v_lecon.editer.php');
		
		break;
}


?>