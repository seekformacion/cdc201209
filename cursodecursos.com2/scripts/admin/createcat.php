<?php 
################ recuperacion de variables GET #####################
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
####################################################################
	
	
include '../variables.php';

$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";


$layouts[76]="comunicacion";
$cats[76][]="Cursos de escritura";



$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

foreach ($cats as $sup => $cates){foreach($cates as $point => $titcat){

	$url=str_replace(" ","_",strtolower($titcat)) . ".html";
	
	$design=$layouts[$sup];
$queryp="INSERT INTO skv_urls (site,visible,titCat,url,tipo,design) values (1,1,'$titcat','/$url',1,'$design')";
$dbnivel->query($queryp);

$queryp= "SELECT LAST_INSERT_ID() as id FROM skv_urls;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$id=$row[id];};	

$queryp="INSERT INTO skv_TextosLandigCat (id_LandingCat) values ($id)";
$dbnivel->query($queryp);

$queryp="INSERT INTO skv_subcats (idcat,idSubCat) values ($sup,$id)";
$dbnivel->query($queryp);

$a=1;
while ($a <= 5){$a++;
$queryp="INSERT INTO skv_CursosVirtuales (id_landingCat) values ($id)";
$dbnivel->query($queryp);
	
}


}}

if (!$dbnivel->close()){die($dbnivel->error());};




?>
