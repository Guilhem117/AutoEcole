<?php if (isset($message)) { echo htmlspecialchars($message); } ?>

<form name="login" action="" method="post" accept-charset="utf-8">
	
	<label for="mail">Adresse mail :</label>
	<input type="email" name="mail" id="mail" value="<?php if (isset($mail)) { echo htmlspecialchars($mail); } ?>" />
	
	<label for="mdp">Mot de passe :</label>
	<input type="password" name="mdp" id="mdp" />
	
	<input type="submit" name="soumission" value="Se connecter" />
</form>