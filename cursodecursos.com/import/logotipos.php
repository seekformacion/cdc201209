<?php

set_time_limit(0);
include "../scripts/variables.php";

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}




global $conf;
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "select id, id_old, nombre, nombre_corto from skv_centros where id in(select id from import_centro where logos = 0) limit 1;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
	$idseek=$row['id'];
	$idofer=$row['id_old'];
	$nombre=$row['nombre'];
	$nombre_corto=$row['nombre_corto'];		
}	

if($nombre_corto){$nombre=$nombre_corto;};

if($idseek){
$nombre=normaliza($nombre);
$nombre=trim(str_replace(" - ","-",$nombre));
$nombre=trim(str_replace(" ","_",$nombre));

$tiposmime[1]="gif";$tiposmime[2]="jpg";$tiposmime[3]="png";$tiposmime[4]="swf";$tiposmime[5]="psd";$tiposmime[6]="bmp";$tiposmime[7]="tif";$tiposmime[8]="tif";$tiposmime[9]="jpc";$tiposmime[10]="jp2";$tiposmime[11]="jpx";$tiposmime[12]="jb2";$tiposmime[13]="swc";$tiposmime[14]="iff";$tiposmime[15]="wbmp";$tiposmime[16]="xbm";$tiposmime[17]="ico";
$ext=$tiposmime[exif_imagetype("http://procenet:nuevaof21@82.223.155.233:81/logos.php?tipo=g&idcentro=$idofer")];

$content2 = file_get_contents("http://procenet:nuevaof21@82.223.155.233:81/logos.php?tipo=g&idcentro=$idofer");
$fp = fopen($paths[www] . "/logos/large/$nombre."  . $ext, "w");
fwrite($fp, $content2); fclose($fp);

$content2 = file_get_contents("http://procenet:nuevaof21@82.223.155.233:81/logos.php?tipo=p&idcentro=$idofer");
$fp = fopen($paths[www] . "/logos/mediun/$nombre."  . $ext, "w");
fwrite($fp, $content2); fclose($fp);

$queryp= "update import_centro set logos=1 where idseek=$idseek;";
$dbnivel->query($queryp);

$queryp= "update skv_centros set file_logo='$nombre.$ext' where id=$idseek;";
$dbnivel->query($queryp);




}


if (!$dbnivel->close()){die($dbnivel->error());};

echo '

<html>
<head>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
</script>
</head>
<body onload="JavaScript:timedRefresh(6000);">
<p>

Insertado logotipo ' . "$nombre.$ext" . '
</p>
</body>
</html>

';


?>