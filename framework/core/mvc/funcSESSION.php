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
$queryp= "INSERT INTO skv_user_sessions (seekforID) values ('$seekforID');";
$dbnivel->query($queryp);
if (!$dbnivel->close()){die($dbnivel->error());};

return $seekforID;
}





?>