<?php
set_time_limit(0);
include "../scripts/variables.php";


$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/fichacurso.php?iddelcentro=939&idcurso=820947');
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=explode("\n",$data); 




foreach ($lineas as $pointer => $codigo){

#nombre del curso
if(strlen($codigo)>strlen(str_replace('<input name="cur_nombre" type="text" class="campos" id="cur_nombre" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_nombre" type="text" class="campos" id="cur_nombre" value="');
$newline=explode('" size="70" onKeyUp=',str_replace($quitosdecurso,'',$codigo))	;
$datos[nomcurso]=trim($newline[0]);	
}

#idcurpropio
if(strlen($codigo)>strlen(str_replace('<input name="cur_id_curso_propio" type="text" class="campos" id="cur_id_curso_propio" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_id_curso_propio" type="text" class="campos" id="cur_id_curso_propio" value="');
$newline=explode('" size="4" onKeyUp=',str_replace($quitosdecurso,'',$codigo))	;
$datos[idcurpropio]=trim($newline[0]);	
}

#cod1
if(strlen($codigo)>strlen(str_replace('<input name="cur_otro_codigo1" type="text" class="campos" id="cur_otro_codigo1" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_otro_codigo1" type="text" class="campos" id="cur_otro_codigo1" value="');
$newline=explode('" size="4" onKeyUp=',str_replace($quitosdecurso,'',$codigo))	;
$datos[cod1]=trim($newline[0]);	
}

#cod2
if(strlen($codigo)>strlen(str_replace('<input name="cur_otro_codigo2" type="text" class="campos" id="cur_otro_codigo2" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_otro_codigo2" type="text" class="campos" id="cur_otro_codigo2" value="');
$newline=explode('" size="4" onKeyUp=',str_replace($quitosdecurso,'',$codigo))	;
$datos[cod2]=trim($newline[0]);	
}


if(strlen($codigo)>strlen(str_replace('<select name="cur_id_tipocurso" class="campos" id="cur_id_tipocurso" onchange="javascript:cambios();">','',$codigo))){$looptipocurso=1;$datos[idtipocurso]="";};
if(strlen($codigo)>strlen(str_replace('</select>','',$codigo))){$looptipocurso=0;}
if($looptipocurso){
if(strlen($codigo)>strlen(str_replace('selected','',$codigo))){
$newline=explode('"',str_replace($quitosdecurso,'',$codigo))	;
$datos[idtipocurso]=trim($newline[1]);
}}


if(strlen($codigo)>strlen(str_replace('<select name="cur_id_certificado" class="campos" id="cur_id_certificado" onchange="javascript:cambios();">','',$codigo))){$loopidcertificado=1;$datos[idcertificado]="";};
if(strlen($codigo)>strlen(str_replace('</select>','',$codigo))){$loopidcertificado=0;}
if($loopidcertificado){
if(strlen($codigo)>strlen(str_replace('selected','',$codigo))){
$newline=explode('"',str_replace($quitosdecurso,'',$codigo))	;
$datos[idcertificado]=trim($newline[1]);
}}


#titoficial
if(strlen($codigo)>strlen(str_replace('<input name="cur_titoficial" type="text" class="campos" id="cur_titoficial" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_titoficial" type="text" class="campos" id="cur_titoficial" value="');
$newline=explode('" size="50" onKeyUp',str_replace($quitosdecurso,'',$codigo))	;
$datos[titoficial]=trim($newline[0]);	
}



if(strlen($codigo)>strlen(str_replace('<select name="cur_id_nivelestudios" class="campos" id="cur_id_nivelestudios" onchange="javascript:cambios();">','',$codigo))){$loopidstudiomin=1;$datos[idstudiomin]="";};
if(strlen($codigo)>strlen(str_replace('</select>','',$codigo))){$loopidstudiomin=0;}
if($loopidstudiomin){
if(strlen($codigo)>strlen(str_replace('selected','',$codigo))){
$newline=explode('"',str_replace($quitosdecurso,'',$codigo))	;
$datos[idstudiomin]=trim($newline[1]);
}}


}

print_r($datos);
print_r($lineas);
?>