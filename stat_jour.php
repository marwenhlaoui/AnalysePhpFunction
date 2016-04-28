<html>
<head>
<title>Statistiques</title>
</head>

<body>
<center>
	<h2 style="color:silver;">Statistiques du jours ^^</h2>
</center>
<?php
	include 'inc/menu.php';
	include 'inc/visiteur_online.php';
	include 'inc/connect.php';
	include 'inc/statistique.php';

echo 'Depuis la création du site, '.allPageVisited().'('.uniquePageVisited().') pages ont été visitées par '.allVisiteurs().' visiteurs.<br /><br /><hr>';

?>

<h1>Voir les statistiques d'un autre jour :</h1>

<form action="" method="post">
	<select name="jour">
		<?php for ($i=1; $i <= 31 ; $i++) :  ?>
			<?php $i = ($i < 10)? '0'.$i : $i ; ?> 
			<?php if(!empty($_POST['jour'])){ ?>
				<option <?php if($_POST['jour'] == $i){ echo "selected";} ?>> <?= $i ?> </option> 
			<?php }else{ ?>
				<option <?php if(date('j') == $i){ echo "selected";} ?>> <?= $i ?> </option> 
			<?php } ?>
		<?php endfor; ?>
	</select>
	<select name="mois">
		<?php for ($i=1; $i <= 12 ; $i++) :  ?>
			<?php $i = ($i < 10)? '0'.$i : $i ; ?> 
			<?php if(!empty($_POST['mois'])){ ?>
				<option <?php if($_POST['mois'] == $i){ echo "selected";} ?>> <?= $i ?> </option> 
			<?php }else{ ?>
				<option <?php if(date('m') == $i){ echo "selected";} ?>> <?= $i ?> </option> 
			<?php } ?>
		<?php endfor; ?>
	</select>
	<select name="annee">
		<?php for ($i = 2000; $i <= date('Y'); $i++) :  ?> 
			<?php if(!empty($_POST['annee'])){ ?>
				<option <?php if($_POST['annee'] == $i){ echo "selected";} ?>> <?= $i ?> </option> 
			<?php }else{ ?>
				<option <?php if(date('Y') == $i){ echo "selected";} ?>> <?= $i ?> </option> 
			<?php } ?>
		<?php endfor; ?>
	</select>
	<input type="submit" value="Voir statiques">
</form>
<?php

  

// on teste si $_POST['jour'], $_POST['mois'], $_POST['annee'] sont vides et déclarées : si oui, c'est que l'on veut voir les statistiques de la date du jour, sinon (elles ne sont pas vides), c'est que l'on a remplit le formulaire qui suit afin de voir les statistiques d'un autre jour précis

if (!isset($_POST['jour']) || !isset($_POST['mois']) || !isset($_POST['annee'])) {
	$date_jour = date("Y-m-d");
}
else {
	if (empty($_POST['jour']) && empty($_POST['mois']) && empty($_POST['annee'])) {
	$date_jour = date("Y-m-d");
	}
	else {
	$date_jour = $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'];
	}
}

// on déclare un tableau ($visite_par_heure) qui aura 24 clés : de 0 à 23, chaque élément du tableau contiendra le nombre de pages vues pendant une tranche horaire (à la clé 0, on aura le nombre de pages vues entre 00:00 et 00:59:59)
$visite_par_heure = array();

$data = visitbydate($date_jour);
 
foreach ($data as $key => $value) {
	$date=$value->date; 

	sscanf($date, "%4s-%2s-%2s %2s:%2s:%2s", $date_Y, $date_m, $date_d, $date_H, $date_i, $date_s);

	 
	if ($date_H < "10"){
		$date_H = substr($date_H, -1);
	}
	 
 
	if (empty($visite_par_heure[$date_H])) {
		$visite_par_heure[$date_H] = 0;
	}
	$visite_par_heure[$date_H] = $visite_par_heure[$date_H]+1; 
	 
}

$total_pages_vu = count($data);

sscanf($date_jour, "%4s-%2s-%2s %2s:%2s:%2s", $date_Y, $date_m, $date_d, $date_H, $date_i, $date_s);

// on affiche le nombre de pages vues en fonction des tranches horaires
echo '<br />Les statistiques du '.$date_d.'/'.$date_m.'/'.$date_Y.' : <br /><br />';

for($i = 1; $i <= 24; $i++) {
	$j = $i-1;
	if (!isset($visite_par_heure[$j])) { 
		echo $j.'H - '.$i.'H : 0 page vue<br />';
	} else { 
		echo $j.'H - '.$i.'H : '.$visite_par_heure[$j].' pages vues<br />';
	}

}

$visiteurUnique = visiteurbydate($date_jour); 
$total_visiteur = count($visiteurUnique);

echo '<br />Soit un total de '.$total_pages_vu.' pages vues par '.$total_visiteur.' visiteurs.<br /><br />';



echo '<br />Les pages les plus vues :<br /><br />';

$pgData = bestpagebydate($date_jour,15);
foreach ($pgData as $key => $data) { 
	$nb_page = $data->nb_page;
	$page = $data->page;
	echo $nb_page.' '.$page.'<br />';
} 



echo '<br />Les visiteurs les plus connectés :<br /><br />';


$visiteurData = bestvisiteurbydate($date_jour,15);

foreach ($visiteurData as $key => $data) { 
	$nb_host = $data->nb_host;
	$host = $data->host;
	echo $nb_host.' '.$host.'<br />';
} 




// on recherche les meilleurs referer sur la journée
echo '<br />Les meilleurs referer :<br /><br />';

$refererData = bestrefererbydate($date_jour,15);

foreach ($refererData as $key => $data) { 
	$nb_referer = $data->nb_referer;
	$referer = $data->referer;
	echo $nb_referer.' <a href="'.$referer.'" target="_blank">'.$referer.'</a><br />';
}
 

 

echo '<br />Les navigateurs et OS :<br /><br />';

$nafandosData = bestnaf_osbydate($date_jour,15);

foreach ($nafandosData as $key => $data) { 
	$nb_navigateur = $data->nb_navigateur;
	$navigateur = $data->navigateur;
	echo $nb_navigateur.' '.$navigateur.'<br />';
}
 
?>
 
</body>
</html>