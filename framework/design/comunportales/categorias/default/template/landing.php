<?php 

include $paths[mvc] . '/catFuncs.php';






$DatosLandingCat=metas($idcat);
$DatosLandingCat[CatRel]=GerCatRel($DatosLandingCat[CatSup],$idcat);
$DatosLandingCat[CatsMenuNav]=GetEnlacesMenuNav ($idcat,$DatosLandingCat[CatRel][subcats]);

$styles .=styles ('css/comunes.css',$design);
$styles .=styles ('css/colores.css',$design);
$styles .=styles ('css/landing.css',$design);
$styles .=styles ('css/menunav.css',$design);
$styles .=styles ('css/cajascursos.css',$design);
$styles .=styles ('css/BloquesFiltros.css',$design);
$styles .=styles ('css/Tabs.css',$design);
$styles .=styles ('css/haches.css',$design);

$javascriptFiles .=JvSfiles ('js/sesion.js',$design);
$javascriptFiles .=JvSfiles ('js/design.js',$design);
$javascriptFiles .=JvSfiles ('js/tabs.js',$design);



$d_layout[metas]=$DatosLandingCat[metas];
$d_layout[styles]=$styles;
$d_layout[javascriptFiles]=$javascriptFiles;
$d_layout[urlIconos]=GetSKINPath('iconos/iconos.png',$design);

include GetPath('template/cabeceralogo.php',$design);
include GetPath('template/Tabs.php',$design);
include GetPath('template/menuNav.php',$design);
include GetPath('template/textosCat.php',$design);


include GetPath('template/tituloListadoLanding.php',$design);
include GetPath('template/listadoCursosLanding.php',$design);



include GetPath('template/CatsRelacionadas.php',$design);
include GetPath('template/GeoLocalizacion.php',$design);
include GetPath('template/BloqueGeografico.php',$design);
include GetPath('template/BloqueTipos.php',$design);


include GetPath('template/CatLandingPagination.php',$design);

include GetPath('template/footer.php',$design);

#########admin
if($vars[MODadmin]){
include GetPath('template/admin/adminLanding.php',$design);	
}else{
$d_layout[admin]="";	
}

############

echo splitsheet(read_layout(GetPath('layout/landing.html',$design)),"layout",$d_layout,"");



?>