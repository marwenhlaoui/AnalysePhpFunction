<?php 
/**** 
 * Titre : Compteur de connectés  
 * Auteur : Merckel Loic  
 * Email : loic@merckel.org 
 * Url : http://merckel.org 
 * Description : Permet d'afficher le nombre de visiteurs connectés. 
(ce script n'utilise pas de base de données). 
****/ 


function nb_visiteurs_connecte() 
{ 
$time=60; //3600
$path = "inc/data";
$filename=$path."/visiteurs.dat" ; 

if (!file_exists($path)) {
            mkdir($path, 0777, true);
}
// $time est le temps en seconde à partir duquel on considère que 
// le visiteur n'est plus connecté 
// $filename est le nom du fichier créé pour stocker les informations 

$ip = getenv("REMOTE_ADDR"); 
    $date=time(); 

    $i=0; 
    $ii=0; 
    $bool=0; 
     
    if(file_exists($filename)) 
    { 
        if($fichier=fopen($filename,"r")) 
        { 
            while(!feof($fichier)) 
            { 
                $ligne=fgets($fichier,4096); 
                $tab=explode("|",$ligne);  
                if((!empty($tab[1]))&&($tab[1]>0)) 
                { 
                    $tab_de_tab[$i][0]=$tab[0]; 
                    $tab_de_tab[$i][1]=$tab[1]; 
         
                    $i++; 
                } 
            } 
            fclose($fichier); 
        } 
    } 

    for($j=0;$j<$i;$j++) 
    { 
        if(($date-chop($tab_de_tab[$j][1]))>$time) 
        { 
            //on ne fait rien 
        } 
        else 
        { 
            $tab_de_tab_actualise[$ii][0]=$tab_de_tab[$j][0]; 
            $tab_de_tab_actualise[$ii][1]=chop($tab_de_tab[$j][1]); 
            $ii++; 
        } 
    } 
     
    for($j=0;$j<$ii;$j++) 
    { 
        if($tab_de_tab_actualise[$j][0]==$ip) 
        { 
            $bool=1; 
        } 
    } 

    if($bool==0) 
    { 
        $tab_de_tab_actualise[$ii][0]=$ip; 
        $tab_de_tab_actualise[$ii][1]=$date; 
        $ii++; 
    } 

    if($fichier=fopen($filename,"w")) 
    { 
        for($j=0;$j<$ii;$j++) 
        { 
            fputs($fichier,chop($tab_de_tab_actualise[$j][0])); 
            fputs($fichier,"|"); 
            fputs($fichier,chop($tab_de_tab_actualise[$j][1])); 
            fputs($fichier,"\n"); 
        } 

        fclose($fichier); 
    } 
    // echo "<b>",$ii,"</b> visiteurs<br>connectés"; 

    return $ii;
    } 

$resultat = nb_visiteurs_connecte(); 
echo "<br><b>$resultat </b>  Visiteurs connectés <br>"; 
?>