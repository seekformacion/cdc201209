<?php


function getUniqueCode($length){
		
$code = md5(uniqid(rand(), true));
if ($length != "") return substr($code, 0, $length);
    else return $code;
}


function create_new_user(){
global $conf;

$seekforID=strtoupper(getUniqueCode(10));



$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT idseek, idofer, cproce from import_centro where cproce < ctotal limit 1;";
#$dbnivel->query($queryp);
if (!$dbnivel->close()){die($dbnivel->error());};

return $seekforID;
}





?>