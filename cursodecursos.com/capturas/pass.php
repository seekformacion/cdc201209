<?php 


$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/fichacurso.php?iddelcentro=9051&idcurso=790051');
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);


$page = curl_exec($c);

print "<pre>\n";
print_r(curl_getinfo($c));  // get error info
echo "\n\ncURL error number:" .curl_errno($c); // print error info
echo "\n\ncURL error:" . curl_error($c); 
print "</pre>\n";

curl_close($c);
echo $page;

?>

