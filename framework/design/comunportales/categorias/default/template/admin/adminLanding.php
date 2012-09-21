<?php 


$rdatos[idcat]=$idcat;
$rdatos_ad_txtcat[idcat]=$idcat;
$rdatos[descripcion]=$DatosLandingCat[Description];
$d_layout[admin]=splitsheet(read_layout(GetPath('layout/admin/edit_metas.html',$design)),"metas",$rdatos, $rdatos);
$d_layout[idcatedit]=$idcat;

$d_layout[textosCat] .=splitsheet(read_layout(GetPath('layout/textosCat.html',$design)),"textosCat_admin",$rdatos_ad_txtcat, $rdatos2);




$d_layout[styles] .=styles ('css/admin.css',$design);
$d_layout[javascriptFiles] .=JvSfiles ('js/admin.js',$design);


?>