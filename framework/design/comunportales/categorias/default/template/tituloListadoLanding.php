<?php 

$rdatos=array();

if($vars[pag]>0){
$d_titulolistcursos[titulolistcursos]=$DatosLandingCat[titCat];
$d_layout[titulolistcursos]=splitsheet(read_layout(GetPath('layout/tituloListadoLanding.html',$design)),"titulolistcursos",$d_titulolistcursos, $rdatos);
}else{
$d_layout[titulolistcursos]="";	
}
?>