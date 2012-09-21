<?php 

################ recuperacion de variables GET #####################
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
####################################################################

include '../variables.php';

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

$value=str_replace("%L%","\n",$value);
$texto=addslashes($value);
$queryp="UPDATE skv_TextosLandigCat SET Texto='$texto' where id_LandingCat=$idcat;";
$dbnivel->query($queryp);



if (!$dbnivel->close()){die($dbnivel->error());};



echo '<p>' . str_replace("\n","<br>",$texto) . '</p>';

?>