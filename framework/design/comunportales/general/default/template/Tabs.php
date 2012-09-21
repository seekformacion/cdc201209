<?php 


$d_ListCompare[cat]=strtolower($DatosLandingCat[titCat]);
$d_TAB[ContListCompare]=splitsheet(read_layout(GetPath('layout/ContListCompare.html',$where[design])),"ContListCompare_Vacio",$d_ListCompare,$d_R_ListCompare);




$d_TAB[urlFondoTab]=GetSKINPath('iconos/fondTab.png',$where[design]);
$d_TAB[urlFondoTabCOPARE]=GetSKINPath('fondos/fondosPestNav/fondoCompara.png',$where[design]);
$d_TAB[urlFondoTabFACE]=GetSKINPath('fondos/fondosPestNav/fondoFacebook.png',$where[design]);

$d_layout[SocialNavigation]=splitsheet(read_layout(GetPath('layout/Tabs.html',$where[design])),"SocialNavigation",$d_TAB,$d_R_urls);


?>