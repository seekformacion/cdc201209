<?php 

################ recuperacion de variables GET #####################
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
####################################################################

include '../variables.php';

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};


$descripcion=addslashes($value);

$queryp="UPDATE skv_urls SET Description='$descripcion' where id=$idcat;";

echo $queryp; 

$dbnivel->query($queryp);

if (!$dbnivel->close()){die($dbnivel->error());};

?>