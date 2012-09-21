
<?php 

$rdatos[titCat]=$DatosLandingCat[titCat];
$d_layout[BloqueTipos]=splitsheet(read_layout(GetPath('layout/BloqueTipos.html',$design)),"BloqueTipos",$rdatos, $rdatos);

?>