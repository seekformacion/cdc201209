<?php 

$rdatos[titCat]=$DatosLandingCat[titCat];
$d_layout[GeoLocalizacion]=splitsheet(read_layout(GetPath('layout/GeoLocalizacion.html',$design)),"GeoLocalizacion",$rdatos, $rdatos);

?>