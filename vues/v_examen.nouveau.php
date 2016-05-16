<?php echo '<p>'.$message.'</p>'; ?>

<form name="examen" action="main.php?rubrique=examen&action=creer" method="post" accept-charset="utf-8">
	
	<label for="date">Date (JJ/MM/AAAA HH:MM:SS) :</label>
	<input type="text" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>" />
	
	<label for="type">Type :</label>
	<select name="type" id="type" />
		<option value="code" <?php if ($type == 'code') { echo 'selected'; } ?> >Code</option>
		<option value="conduite" <?php if ($type == 'conduite') { echo 'selected'; } ?> >Conduite</option>
	</select>
	
	<input type="submit" name="soumission" value="Valider" />
</form>

<a href="main.php?rubrique=examen&action=lister">Retour</a>