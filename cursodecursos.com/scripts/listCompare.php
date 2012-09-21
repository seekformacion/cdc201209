<?php 
################ recuperacion de variables GET #####################
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
####################################################################


include 'variables.php';
global $where;
$where[tipo]="categorias";

$id=0;
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

$queryp= "SELECT id FROM ListCompare where idCurso='$codCompare';";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$id=$row[id];};


if($id>0){ 
$queryp= "delete FROM ListCompare where id='$id';"; 
}else{
$queryp="insert into ListCompare (idCurso) values ($codCompare);";

}
$dbnivel->query($queryp);




$queryp= "SELECT idCurso, id FROM ListCompare;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
$count++;
$d_R_ListCompare[cadaCurso][$row[id]][titulo]="Técnico en Prevención de Riesgos Laborales en la " . $row[idCurso];
$d_R_ListCompare[cadaCurso][$row[id]][codcurso]=$row[idCurso];

}

sleep(1);
if($count>0){
echo splitsheet(read_layout(GetPath('layout/ContListCompare.html',$idcat)),"ContListCompare_Datos",$d_ListCompare,$d_R_ListCompare);
}else{
echo splitsheet(read_layout(GetPath('layout/ContListCompare.html',$idcat)),"ContListCompare_Vacio",$d_ListCompare,$d_R_ListCompare);
}

if (!$dbnivel->close()){die($dbnivel->error());};
?>

