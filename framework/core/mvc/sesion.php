<?php 

$urltotal=$_SERVER['REQUEST_URI'];


$sessD=explode("\?SSID=",$urltotal);

$vars[url]=$sessD[0];
$vars[SSID]=$sessD[1];

### compruebo admintemporal
if($vars[SSID]=="vero"){$vars[MODadmin]=true;}else{$vars[MODadmin]=FALSE;};

?>
