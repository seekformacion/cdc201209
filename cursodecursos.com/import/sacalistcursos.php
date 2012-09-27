<?php

set_time_limit(0);

include "../scripts/variables.php";

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT idseek, idofer, cproce from import_centro where cproce < ctotal limit 1;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
	$idseek=$row['idseek'];
	$idofer=$row['idofer'];
	$cproce=$row['cproce'];
}	
$pag=round(($cproce/30),0)+1;

$lineas=array();
$c = curl_init("http://procenet:nuevaof21@82.223.155.233:81/listacursos.php?filtroestado=0&iddelcentro=$idofer&pag=$pag");
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=explode("\n",$data); 




foreach ($lineas as $pointer => $codigo){

#nombre del centro
if(strlen($codigo)>strlen(str_replace('<img src="/iconos/visible2.gif" width="16" height="16" onClick="javascript:cambiavisibilidad(','',$codigo))){
$quitosdecurso=array('<img src="/iconos/visible2.gif" width="16" height="16" onClick="javascript:cambiavisibilidad(');
$valores=explode(');" id=',trim(str_replace($quitosdecurso,'',$codigo)));
$cursos[]=$valores[0];$contador++;
}

if(strlen($codigo)>strlen(str_replace('<img src="/iconos/novisible2.gif" width="16" height="16" onClick="javascript:cambiavisibilidad(','',$codigo))){
$quitosdecurso=array('<img src="/iconos/novisible2.gif" width="16" height="16" onClick="javascript:cambiavisibilidad(');
$valores=explode(');" id=',trim(str_replace($quitosdecurso,'',$codigo)));
$cursosno[]=$valores[0];$contador++;
}

if(strlen($codigo)>strlen(str_replace('<a href="#" span class="Titulo1">Del <span class="Titulo5">','',$codigo))){
$quitosdecurso=array('<a href="#" span class="Titulo1">Del <span class="Titulo5">','</span>');
$valores2=explode('de <span class="Titulo5">',trim(str_replace($quitosdecurso,'',$codigo)));
$total=$valores2[1];
}


}

if(count($cursos)>0){foreach($cursos as $pointer => $idcur){
$queryp= "insert into import_cursos_si (idseek,idofer,idcur) values ($idseek,$idofer,$idcur);";
$dbnivel->query($queryp);	
}}

if(count($cursosno)>0){foreach($cursosno as $pointer => $idcur){
$queryp= "insert into import_cursos_no (idseek,idofer,idcur) values ($idseek,$idofer,$idcur);";
$dbnivel->query($queryp);	
}}

$queryp= "update import_centro set cproce=cproce + $contador where idseek=$idseek;";
$dbnivel->query($queryp);

$queryp= "update import_centro set ctotal=$total where idseek=$idseek;";
$dbnivel->query($queryp);

#print_r($cursos);
#print_r($cursosno);
#echo $total;
#print_r($lineas);
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
<body onload="JavaScript:timedRefresh(200);">
<p>

Insertados cursos de pagina: ' . $pag . '
</p>
</body>
</html>

';


?>