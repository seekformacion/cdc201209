<?php

include ('variables.php');
include $paths[mvc] . '/funcSESSION.php';	




if (isset($_COOKIE["seekforID"])){
	
echo "yaaaa";
	
}else{
	

echo create_new_user();
	
$expire=time()+60*60*24*30;
#setcookie("seekforID", "XUJD838YD3HD", $expire);	
}


?>
