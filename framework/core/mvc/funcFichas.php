<?php 

function GetCatFromCUR($idcur){


global $paths;
global $vars;
global $conf;
global $where;	

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "select Id, design from skv_urls where id IN (select id_cat from skv_relCurCats where id_cur=$idcur);";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
$design=$row[design];
$where[idcatcur]=$row[Id];
}

if (!$dbnivel->close()){die($dbnivel->error());};

if(!$where[design]){$where[design]=$design;}

}




function GetDATFromCUR($idcur){


global $paths;
global $vars;
global $conf;
global $where;	



$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "select * from skv_cursos where id=$idcur;";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){

$DatCur=$row;
}

if (!$dbnivel->close()){die($dbnivel->error());};

return $DatCur;

}





?>