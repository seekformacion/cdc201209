<?php 

################ recuperacion de variables GET #####################
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
####################################################################

include '../variables.php';

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};


$tit=addslashes($tit);
$desc=addslashes($desc);

$queryp="UPDATE skv_CursosVirtuales SET Titulo='$tit', Descripcion='$desc' where id=$idvir;";
$dbnivel->query($queryp);



if (!$dbnivel->close()){die($dbnivel->error());};



echo $tit . '||' . $desc . '||' .$idvir;

?>