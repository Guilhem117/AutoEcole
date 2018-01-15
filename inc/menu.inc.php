<?php
	
	$rubrique = '';
	
	if (isset($_GET['rubrique'])) {
		$rubrique = $_GET['rubrique'];
	}
	
?>

<nav>
	<ul id="menu">
		<li><a href='main.php?rubrique=index'<?php if (($rubrique == 'index') or ($rubrique == '')) { echo ' class="selection"'; } ?>>Accueil</a></li>
	
		<?php if (isset($_SESSION['mail'])) { ?>
			<li><a href='main.php?rubrique=examen'<?php if ($rubrique == 'examen') { echo ' class="selection"'; } ?>>Examens</a></li>
			<li><a href='main.php?rubrique=vehicule'<?php if ($rubrique == 'vehicule') { echo ' class="selection"'; } ?>>Véhicules</a></li>
			<li><a href='main.php?rubrique=achat'<?php if ($rubrique == 'achat') { echo ' class="selection"'; } ?>>Achats de tickets</a></li>
			<li><a href='main.php?rubrique=lecon'<?php if ($rubrique == 'lecon') { echo ' class="selection"'; } ?>>Leçons</a></li>
			<li><a href='main.php?rubrique=eleve'<?php if ($rubrique == 'eleve') { echo ' class="selection"'; } ?>>Elèves</a></li>
			<li><a href='main.php?rubrique=responsable'<?php if ($rubrique == 'responsable') { echo ' class="selection"'; } ?>>Responsables</a></li>
			<li><a href='main.php?rubrique=salarie'<?php if ($rubrique == 'salarie') { echo ' class="selection"'; } ?>>Salariés</a></li>
			<li><a href='main.php?rubrique=formule'<?php if ($rubrique == 'formule') { echo ' class="selection"'; } ?>>Formules</a></li>
			<li><a href='inc/deconnexion.php'>Se déconnecter</a></li>
		<?php } else { ?>
			<li><a href='main.php?rubrique=login'<?php if ($rubrique == 'login') { echo ' class="selection"'; }	?>>Se connecter</a></li>
		<?php } ?>	
	</ul>
</nav>	
	