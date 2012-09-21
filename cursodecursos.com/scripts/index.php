<?php 

include 'variables.php';
global $where;




$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
mysql_query("SET NAMES 'utf8'");
$queryp= "SELECT * FROM skv_urls where url='$vars[url]' AND visible=1;";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
	$idcat=$row[id];
	$where[tipo]=$vars[tipos][$row[tipo]];
	$where[idtipo]=$row[tipo];
	$where[idrel]=$row[idrel];
	$where[design]=$row[design];
	$design=$row[design];
}
if (!$dbnivel->close()){die($dbnivel->error());};



if ($where[idtipo]==1){


if($vars[pag]>0){
include GetPath('template/landing-pag.php',$where[design]);### paginas 
}else{
include GetPath('template/landing.php',$where[design]);#### landing
}}


if ($where[idtipo]==3){
include $paths[mvc] . '/funcFichas.php';	
GetCatFromCUR($where[idrel]);
include GetPath('template/ficha.php',$where[design]);### paginas 
}



?>

