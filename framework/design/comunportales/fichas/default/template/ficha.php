<?php 



$styles .=styles ('css/comunes.css',$where[design]);
$styles .=styles ('css/colores.css',$where[design]);
$styles .=styles ('css/ficha.css',$where[design]);
$styles .=styles ('css/Tabs.css',$design);
$styles .=styles ('css/haches.css',$where[design]);
$styles .=styles ('css/mapa.css',$where[design]);
$styles .=styles ('css/formulario.css',$where[design]);

$javascriptFiles .=JvSfiles ('js/sesion.js',$where[design]);
#$javascriptFiles .=JvSfiles ('js/design.js',$where[design]);
$javascriptFiles .=JvSfiles ('js/tabs.js',$where[design]);
$javascriptFiles .=JvSfiles ('js/form.js',$where[design]);



$DatosLandingCat=metas($where[idcatcur]);
#$d_layout[metas]=$DatosLandingCat[metas];

$d_layout[urlICONOS]=GetSKINPath('iconos/iconos.png',$where[design]);
$d_layout[idcatcur]=imgcat($where[idcatcur]);
$d_layout[styles]=$styles;
$d_layout[javascriptFiles]=$javascriptFiles;

$d_layout[urlMAPA]=GetSKINPath('iconos/provincias.gif',$where[design]);
$d_layout[urlIconos]=GetSKINPath('iconos/iconos.png',$where[design]);

include GetPath('template/Tabs.php',$where[design]);
include GetPath('template/cabeceralogo.php',$where[design]);
include GetPath('template/formulario.php',$where[design]);
include GetPath('template/footer.php',$where[design]);
echo splitsheet(read_layout(GetPath('layout/ficha.html',$where[design])),"layout",$d_layout,"");



?>