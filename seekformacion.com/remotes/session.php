<?php
header("content-type: application/json"); 
include ('variables.php');
include $paths[mvc] . '/funcSESSION.php';	




if (isset($_COOKIE["seekforID"])){
$seekforID= $_COOKIE["seekforID"];
}else{
$seekforID=create_new_user();
$expire=time()+60*60*24*30;
setcookie("seekforID", $seekforID, $expire);
}



if (isset($_GET['id'])) $rtnjsonobj->id = $_GET['id']; 
$rtnjsonobj->message = $seekforID;
echo $_GET['callback']. '('. json_encode($rtnjsonobj) . ')';  

?>
