<?php

set_time_limit(0);

include "../scripts/variables.php";



$content2 = file_get_contents("http://procenet:nuevaof21@82.223.155.233:81/logos.php?tipo=g&idcentro=939");
$fp = fopen($paths[www] . "/logos/masterd.gif", "w");
fwrite($fp, $content2); fclose($fp);



?>