<?php
	
$hote = '127.0.0.1';
$port = '1521';
$service = 'XE';
$utilisateur = 'maximilien';
$motdepasse = 'oracle';

$lien_base =
"oci:dbname=(DESCRIPTION =
(ADDRESS_LIST =
	(ADDRESS =
		(PROTOCOL = TCP)
		(Host = ".$hote .")
		(Port = ".$port."))
)
(CONNECT_DATA =
	(SERVICE_NAME = ".$service.")
)
)";

try {
	$cnx = new PDO($lien_base, $utilisateur, $motdepasse);
} catch (PDOException $e) {
	echo $e->getMessage();
}