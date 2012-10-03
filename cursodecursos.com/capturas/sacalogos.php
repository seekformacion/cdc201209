<?php 
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

$vars[siteId]=1;
$vars[site]="cursos";
$vars[url]=$_SERVER['REQUEST_URI'];

$vars[tipos][1]="categorias";



######## includes

include $paths[mvc] . '/reedtemplates.php';
include $paths[mvc] . '/headers.php';
include $paths[dtb] . '/db.php';

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
mysql_query("SET NAMES 'utf8'");
$queryp= "SELECT id,id_old FROM skv_centros WHERE ext_logo = '-';";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$cents[$row[id]]=$row[id_old];};

foreach ($cents as $id => $id_old){
$content = file_get_contents("http://www.ofertaformativa.com/logosp/$id_old.gif");

if(strlen($content)>290){
$fp = fopen($paths[www] . "/logos/medium/$id.gif", "w");
fwrite($fp, $content); fclose($fp);
$content2 = file_get_contents("http://www.ofertaformativa.com/logosg/$id_old.gif");
$fp = fopen($paths[www] . "/logos/large/$id.gif", "w");fwrite($fp, $content2); fclose($fp);
$extn="gif";

}else{
$content = file_get_contents("http://www.ofertaformativa.com/logosp/$id_old.jpg");
if(strlen($content)>290){$fp = fopen($paths[www] . "/logos/medium/$id.jpg", "w"); fwrite($fp, $content); fclose($fp);
$content2 = file_get_contents("http://www.ofertaformativa.com/logosg/$id_old.jpg");
$fp = fopen($paths[www] . "/logos/large/$id.jpg", "w");fwrite($fp, $content2); fclose($fp);
$extn="jpg";


}else{ 
$content = file_get_contents("http://www.ofertaformativa.com/logosp/$id_old.png");
if(strlen($content)>290){$fp = fopen($paths[www] . "/logos/medium/$id.png", "w"); fwrite($fp, $content); fclose($fp);
$content2 = file_get_contents("http://www.ofertaformativa.com/logosg/$id_old.png");
$fp = fopen($paths[www] . "/logos/large/$id.png", "w");fwrite($fp, $content2); fclose($fp);
$extn="png";

}

}}


$queryp= "update skv_centros SET ext_logo = '$extn' WHERE id=$id;";
$dbnivel->query($queryp);

}

if (!$dbnivel->close()){die($dbnivel->error());};
?>