
 <?php

 /* record_stat.php */
// récupération de l'heure courante
$date_courante = date("Y-m-d H:i:s");

// récupération de l'adresse IP du client (on cherche d'abord à savoir si il est derrière un proxy)
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
  $ip  = $_SERVER['HTTP_CLIENT_IP'];
}
else {
  $ip = $_SERVER['REMOTE_ADDR'];
}
// récupération du domaine du client
$host = gethostbyaddr($ip);

// récupération du navigateur et de l'OS du client
$navigateur = $_SERVER['HTTP_USER_AGENT'];

// récupération du REFERER
if (isset($_SERVER['HTTP_REFERER'])) {
	 
	$referer = $_SERVER['HTTP_REFERER']; 
}
else {
  $referer ='';
}

// récupération du nom de la page courante ainsi que ses arguments
if ($_SERVER['QUERY_STRING'] == "") {
  $page_courante = $_SERVER['PHP_SELF'];
}
else {
  $page_courante = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}

 

if((!isset($_SESSION['last_pg']))OR($_SESSION['last_pg']['url'] != $page_courante)OR(($_SESSION['last_pg']['url'] == $page_courante)AND($_SESSION['last_pg']['time'] < time()))){
	// insertion des éléments dans la base de données 
	$req2 = $connection->prepare('INSERT INTO statistiques VALUES("", "'.$date_courante.'", "'.$page_courante.'", "'.$ip.'", "'.$host.'", "'.$navigateur.'", "'.$referer.'")');
	$req2->execute();
	$_SESSION['last_pg']['url'] = $page_courante;
	$_SESSION['last_pg']['time'] = time() + 3600;//1h
}



?>

 