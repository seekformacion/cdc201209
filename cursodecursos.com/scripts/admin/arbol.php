
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
	
	<script>
		function edita(sup,act){
			var sup; var act;
			window.open('poparbol.php?sup=' + sup + '&act=' + act,'Window1','menubar=no,width=430,height=360,toolbar=no');
		}
	</script>
	
	
<?php
################ recuperacion de variables GET #####################
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
####################################################################
	
	
include '../variables.php';



$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};


$queryp= "SELECT *  FROM skv_equiarbol;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$equiarbol[$row[idofer]]=$row[idseek];};	

if (!$dbnivel->close()){die($dbnivel->error());};





$conf[db]="laiislac_seekformacion";

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};


$queryp= "SELECT *  FROM categorias2;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
	$cats[$row[id_categoria]]=$row[cat_nombre];
	$arbol[$row[id_cat_superior]][]=$row[id_categoria];
	
	asort($arbol);


};	

if (!$dbnivel->close()){die($dbnivel->error());};


if(!$idcat){$idcat=1;};



echo "
$cats[$idcat] 
<ul>";




$subs=$arbol[$idcat];



		 if(count($subs)>0){
		 	
		 foreach ($subs as $point => $id2){
		 	$v="";
			if($equiarbol[$id2]){$v='<span style="color:green; font-family:Arial; font-size:9px;">V</span>';}
			
		 	if(count($arbol[$id2])>0){
		 	echo "<li> <a href='arbol.php?idcat=$id2'> $cats[$id2] </a>  $v  <span style='cursor:pointer; font-family:arial; color:red; font-size:10px;' onclick='javascript:edita($idcat,$id2);'> editar </span></li>";
		 }else{
		 	echo "<li> $cats[$id2]   $v  <span style='cursor:pointer; font-family:arial; color:red; font-size:10px;' onclick='javascript:edita($idcat,$id2);'> editar </span></li>";
		 }
		 }
		 
		 }
	
echo "</ul>";	




?>


