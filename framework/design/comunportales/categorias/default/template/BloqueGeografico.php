<?php 

$rdatos[titCat]=$DatosLandingCat[titCat];
$d_layout[BloqueGeografico]=splitsheet(read_layout(GetPath('layout/BloqueGeografico.html',$design)),"BloqueGeografico",$rdatos, $rdatos);

?>