<?php 

function GerCatRel ($IdcatSUP,$idcat){


global $paths;
global $vars;
global $conf;
	

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT id, titCat, url FROM skv_urls where id IN (select idSubCat from skv_subcats WHERE idcat=$IdcatSUP AND idSubCat <> $idcat)";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
$count++;
	$subcats[subcats][$count][titleSubCat]=$row[titCat];
	$subcats[subcats][$count][urSubCat]=$row[url];
	$subcats[subcats][$count][id]=$row[id];
}

if (!$dbnivel->close()){die($dbnivel->error());};



return $subcats;

}



function GetEnlacesMenuNav ($idcat,$catRels){
global $paths;
global $vars;
global $conf;
	
$over="over";

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT idcatAsociada FROM skv_CatsMenuNav where idcat=$idcat)";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idcatAsociada[]=$row[idcatAsociada];};
if (!$dbnivel->close()){die($dbnivel->error());};



while(count($idcatAsociada)<3){$count++;
$idcatAsociada[]=$catRels[$count][id];
}



foreach ($idcatAsociada as $pointer => $idcatasoc){if($idcatasoc > 0){
$pointer++;


$DatosCatMenunav=array();
$DatosFROMUrl=array();

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT TitSup, UrlTitsup, Title, UrlCat, miniTXT FROM skv_miniTXTCat WHERE idCat=$idcatasoc;";
$dbnivel->query($queryp);

while ($row = $dbnivel->fetchassoc()){
$DatosCatMenunav[TitSup]=$row[TitSup];
$DatosCatMenunav[UrlTitsup]=$row[UrlTitsup];
$DatosCatMenunav[Title]=$row[Title];
$DatosCatMenunav[UrlCat]=$row[UrlCat];
$DatosCatMenunav[miniTXT]=$row[miniTXT];
}
if (!$dbnivel->close()){die($dbnivel->error());};


$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT site, titCat, url, Description FROM skv_urls WHERE id=$idcatasoc;";

$dbnivel->query($queryp);

while ($row = $dbnivel->fetchassoc()){

$d_R_urls[menu][$pointer][id]=$pointer;
$d_R_urls[menu][$pointer][over]=$over;$over="out";



if(($DatosCatMenunav[TitSup])&&($DatosCatMenunav[UrlTitsup])){
	$d_R_urls[menu][$pointer][site]=$DatosCatMenunav[TitSup];
	$d_R_urls[menu][$pointer][URLsite]=$DatosCatMenunav[UrlTitsup];
	
}else{
	
	$d_R_urls[menu][$pointer][site]=strtoupper($conf[equisitesT][$row[site]]);
	$d_R_urls[menu][$pointer][URLsite]=$conf[equisitesU][$row[site]];
}



if(($DatosCatMenunav[Title])&&($DatosCatMenunav[UrlCat])){
	$d_R_urls[menu][$pointer][categoria]=$DatosCatMenunav[Title];
	$d_R_urls[menu][$pointer][URLcategoria]=$DatosCatMenunav[UrlCat];

}else{
	$d_R_urls[menu][$pointer][categoria]=$row[titCat];
	$d_R_urls[menu][$pointer][URLcategoria]=$row[url];
}


if($DatosCatMenunav[miniTXT]){$d_R_urls[menu][$pointer][detalle]=$DatosCatMenunav[miniTXT];}else{$d_R_urls[menu][$pointer][detalle]=$row[Description];};


}
if (!$dbnivel->close()){die($dbnivel->error());};




}}


return $d_R_urls;
}




function GetCursCAT ($idcat){

global $paths;
global $vars;
global $conf;
	
$inicio=($vars[pag]-1)*10;
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT id, id_cur FROM skv_relCurCats WHERE id_cat=$idcat LIMIT $inicio, $vars[curporpag] ;";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$cursos[]=$row[id_cur];};

if (!$dbnivel->close()){die($dbnivel->error());};
return $cursos;
}



function COUNTCursCAT ($idcat){

global $paths;
global $vars;
global $conf;
	
$inicio=($vars[pag]-1)*10;
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT count(id) as cuenta FROM skv_relCurCats WHERE id_cat=$idcat;";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$cuenta=$row[cuenta];};

if (!$dbnivel->close()){die($dbnivel->error());};
return $cuenta;
}




?>