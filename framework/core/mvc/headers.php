


<?php 





function metas ($idcat){

global $paths;
global $vars;
global $conf;
global $where;	

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT id, titCat, url, Title, Keywords, Description, (select idcat from skv_subcats where idSubCat='$idcat') as CatSup FROM skv_urls where id='$idcat';";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
	$DatosLandingCat[titCat]=$row[titCat];
	$DatosLandingCat[url]=$row[url];
	$DatosLandingCat[CatSup]=$row[CatSup];
	
	if($row[Title]){$DatosLandingCat[Title]=$row[Title];}else{$DatosLandingCat[Title]=$row[titCat];};
	if($row[Keywords]){$DatosLandingCat[Keywords]=$row[Keywords];}else{$DatosLandingCat[Keywords]=$row[titCat];};
	if($row[Description]){$DatosLandingCat[Description]=$row[Description];}else{$DatosLandingCat[Description]=$row[titCat];};
}
if (!$dbnivel->close()){die($dbnivel->error());};




$url=$conf[equisitesU][$where[idtipo]] . $DatosLandingCat[url] . "#SIDea973092737297";
$DatosLandingCat[metas]= "<title>$DatosLandingCat[Title]</title>

<meta name='description' content='$DatosLandingCat[Description]' />
<meta name='keywords' content='$DatosLandingCat[Keywords]' />
<meta name='robots' content='NOINDEX,NOFOLLOW' />

<meta property='og:title' content='$DatosLandingCat[Title]' />
<meta property='og:url' content='$url' />
<meta property='og:description' content='$DatosLandingCat[Description]' />
<meta property='og:image' content='http://cursodecursos.com/images/img_Facebook/$idcat.jpg' />
<meta property='og:site_name' content='SeekFormacion : Cursos' />
<meta property='og:type' content='article' />
<meta property='fb:admins' content='1018154356' />
";	
return $DatosLandingCat;
	
}




function styles ($objeto,$id){
	
global $paths;
global $vars;
	
	$url=GetSKINPath ($objeto,$id);
	return "\n" . "<link rel='stylesheet' type='text/css' href='$url' />";
}


function JvSfiles ($objeto,$id){
	
global $paths;
global $vars;
	
	$url=GetSKINPath ($objeto,$id);
	return "\n" . "<script type='text/javascript' src='$url'></script>";
}







#################################### comprobamos template especifico
function imgcat($idcat){
	
global $paths;
global $vars;

$donde=$paths[imgcat] . '/' . $idcat . '.jpg';

if (file_exists($donde)) {$url= '/images/fondosCats/'  . $idcat . '.jpg';}
 					else {$url= '/images/fondosCats/general.gif';};
	
	
	return $url;

}


function logocat($idcat){
	
global $paths;
global $vars;

$donde=$paths[imgLogo] . '/logo' . $idcat . '.png';


if (file_exists($donde)) {$url= '/images/logosCat/logo'  . $idcat . '.png';}
 					else {$url= '/images/logosCat/logo.png';};
	
	
	return $url;

}
#########################################################################




?>