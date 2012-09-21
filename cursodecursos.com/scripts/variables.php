<?php

global $conf;

global $paths;
global $vars;
global $conf;

################################## DB connect
$conf[host]="localhost";
$conf[db]="laiislac_seekvero";
$conf[usr]="laiislac";
$conf[pass]="ideosites2009";


$conf[equisitesT][1]="cursos";$conf[equisitesU][1]="http://cursodecursos.com";

$paths[root]="/home/laiislac/seekvero";
$paths[www]="/home/laiislac/www/cursodecursos.com";


$paths[dtb]=$paths[root] . "/core/db";
$paths[mvc]=$paths[root] . "/core/mvc";


$paths[obj]=$paths[root] . "/objects";
$paths[ly]=$paths[root] . "/layouts";
$paths[tmp]=$paths[root] . "/templates";


$paths[css]=$paths[www] . "/css";
$paths[imgcat]=$paths[www] . "/images/fondosCats";
$paths[imgLogo]=$paths[www] . "/images/logosCat";


$vars[curporpag]=10;
$vars[siteId]=1;
$vars[site]="cursos";


##################################
include $paths[mvc] . '/sesion.php'; ### USER SESION
##################################

#$vars[url]=$_SERVER['REQUEST_URI'];
######### compruebo paginacion
if(strlen($vars[url])  > strlen(str_replace('-pag','',$vars[url]))){
$fragurl=split('-pag',$vars[url]);
$vars[url]=$fragurl[0] . '.html';
$vars[pag]=str_replace('.html','',$fragurl[1]);
}
####################################


$vars[tipos][1]="categorias";
$vars[tipos][3]="fichas";


######## includes

include $paths[mvc] . '/reedtemplates.php';
include $paths[mvc] . '/headers.php';
include $paths[dtb] . '/db.php';


?>