<?php



function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}


function dd($data)
{
    return die(debug($data));
}


 

	// on cherche le nombre de pages visitées depuis le début (création du site)

	function allPageVisited(){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		
		$req = $connection->prepare('SELECT page FROM statistiques');
            $req->execute();
            $data = $req->fetchAll(); 
		 return count($data);
	}

	function uniquePageVisited(){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		
		$req = $connection->prepare('SELECT DISTINCT(page) FROM statistiques');
            $req->execute();
            $data = $req->fetchAll(); 
		 return count($data);
	}

	// on cherche le nombre de visiteurs depuis le début (création du site)
	function allVisiteurs(){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		
		$req = $connection->prepare('SELECT DISTINCT(ip) FROM statistiques');
            $req->execute();
            $data = $req->fetchAll(); 
		 return count($data);
	}
 	
 	function visitbydate($date){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
 		$sql = 'SELECT date FROM statistiques WHERE date LIKE "'.$date.'%" ORDER BY date ASC';
			$req = $connection->prepare($sql);
            $req->execute(); 
            $data = $req->fetchAll();
            return $data;
 	}

 	// on calcule le nombre de visiteurs de la journée  
 	function visiteurbydate($date){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		$sql = 'SELECT DISTINCT(ip) FROM statistiques WHERE date LIKE "'.$date.'%" ORDER BY date ASC';
			$req = $connection->prepare($sql);
            $req->execute(); 
            $data = $req->fetchAll();
            return $data;
 	}

// on recherche les pages qui ont été les plus vues sur la journée (on calcule au passage le nombre de fois qu'elles ont été vu) 
 	function bestpagebydate($date,$limit=null){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		    $limit = (!empty($limit))? $limit : 10 ;
		 	$sql = 'SELECT distinct(page), count(page) as nb_page FROM statistiques WHERE date LIKE "'.$date.'%" GROUP BY page ORDER BY nb_page DESC LIMIT 0,'.$limit.'';
			$req = $connection->prepare($sql);
            $req->execute(); 
            $data = $req->fetchAll();
            return $data;
 	}

// on recherche les visiteurs qui ont été les plus connectes au site sur la journée (on calcule au passage le nombre de page qu'ils ont chargé)
 	function bestvisiteurbydate($date,$limit=null){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		    $limit = (!empty($limit))? $limit : 10 ;
		 	$sql = 'SELECT distinct(host), count(host) as nb_host FROM statistiques WHERE date LIKE "'.$date.'%" GROUP BY host ORDER BY nb_host DESC LIMIT 0,'.$limit.'';
			$req = $connection->prepare($sql);
            $req->execute(); 
            $data = $req->fetchAll();
            return $data;
 	}

// on recherche les meilleurs referer sur la journée
 	function bestrefererbydate($date,$limit=null){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		    $limit = (!empty($limit))? $limit : 10 ;
		 	$sql = 'SELECT distinct(referer), count(referer) as nb_referer FROM statistiques WHERE date LIKE "'.$date.'%" AND referer!="" GROUP BY referer ORDER BY nb_referer DESC LIMIT 0,'.$limit.'';
			$req = $connection->prepare($sql);
            $req->execute(); 
            $data = $req->fetchAll();
            return $data;
 	}

// on recherche les navigateurs et les OS utilisés par les visiteurs (on calcule au passage le nombre de page qui ont été chargés avec ces systèmes)
 	function bestnaf_osbydate($date,$limit=null){
		 if ( ! isset($connection)) {
		        global $connection;
		    }
		    $limit = (!empty($limit))? $limit : 10 ;
		 	$sql = 'SELECT distinct(navigateur), count(navigateur) as nb_navigateur FROM statistiques WHERE date LIKE "'.$date.'%" GROUP BY navigateur ORDER BY nb_navigateur DESC LIMIT 0,'.$limit.'';
			$req = $connection->prepare($sql);
            $req->execute(); 
            $data = $req->fetchAll();
            return $data;
 	}

