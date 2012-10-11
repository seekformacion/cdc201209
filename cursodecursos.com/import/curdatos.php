<?php
set_time_limit(0);
include "../scripts/variables.php";
include "../scripts/valores.php";

function utf8_encode_deep(&$input) {
    if (is_string($input)) {
        $input = utf8_encode($input);
    } else if (is_array($input)) {
        foreach ($input as &$value) {
            utf8_encode_deep($value);
        }

        unset($value);
    } else if (is_object($input)) {
        $vars = array_keys(get_object_vars($input));

        foreach ($vars as $var) {
            utf8_encode_deep($input->$var);
        }
    }
}



function datoscurso($idc,$idcur,$idcentseek){
global $conf;
global $eqip_of_seek;

$lineas=array();
$c = curl_init("http://procenet:nuevaof21@82.223.155.233:81/fichacurso.php?iddelcentro=$idc&idcurso=$idcur");
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=explode("\n",$data); 



$datos[m_precio]=0;

foreach ($lineas as $pointer => $codigo){

#nombre del curso
if(strlen($codigo)>strlen(str_replace('<input name="cur_nombre" type="text" class="campos" id="cur_nombre" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_nombre" type="text" class="campos" id="cur_nombre" value="');
$newline=explode('" size="70" onKeyUp=',str_replace($quitosdecurso,'',$codigo))	;
$datos[nomcurso]=trim($newline[0]);	


$finnom=1000;
if( (strpos($datos[nomcurso],' -')<$finnom) && (strpos($datos[nomcurso],' -')>0) ){$finnom=strpos($datos[nomcurso],' -');};
if( (strpos($datos[nomcurso],' (')<$finnom) && (strpos($datos[nomcurso],' (')>0) ){$finnom=strpos($datos[nomcurso],' (');};

$datos[nomcursoalt]=substr($datos[nomcurso],0,$finnom*1);


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



if(strlen($codigo)>strlen(str_replace('<select name="cur_id_metodo" class="campos" id="cur_id_metodo" onchange="javascript:cambios();">','',$codigo))){$loopmetodo=1;$datos[idmetodo]="";};
if(strlen($codigo)>strlen(str_replace('</select>','',$codigo))){$loopmetodo=0;}
if($loopmetodo){
if(strlen($codigo)>strlen(str_replace('selected','',$codigo))){
$newline=explode('"',str_replace($quitosdecurso,'',$codigo))	;
$datos[idmetodo]=trim($newline[1]);
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


#precio
if(strlen($codigo)>strlen(str_replace('<input name="cur_precio" type="text" class="campos" id="cur_precio" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_precio" type="text" class="campos" id="cur_precio" value="');
$newline=explode('" size=',str_replace($quitosdecurso,'',$codigo))	;
$datos[precio]=trim($newline[0]);	
}

#mostrar_precio
if(strlen($codigo)>strlen(str_replace('<input type="checkbox" name="cur_mostarprecio" id="cur_mostarprecio" value="1" checked','',$codigo))){
$datos[m_precio]=1;
}


#facilidades
if(strlen($codigo)>strlen(str_replace('<input name="cur_facilidad" type="text" class="campos" id="cur_facilidad" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_facilidad" type="text" class="campos" id="cur_facilidad" value="');
$newline=explode('" size=',str_replace($quitosdecurso,'',$codigo))	;
$datos[facilidades]=trim($newline[0]);	
}


#practicas
if(strlen($codigo)>strlen(str_replace('<input name="cur_practicas" type="text" class="campos" id="cur_practicas" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_practicas" type="text" class="campos" id="cur_practicas" value="');
$newline=explode('" size=',str_replace($quitosdecurso,'',$codigo))	;
$datos[practicas]=trim($newline[0]);	
}

#otrosdatos
if(strlen($codigo)>strlen(str_replace('<input name="cur_otrosdatos" type="text" class="campos" id="cur_otrosdatos" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_otrosdatos" type="text" class="campos" id="cur_otrosdatos" value="');
$newline=explode('" size=',str_replace($quitosdecurso,'',$codigo))	;
$datos[otrosdatos]=trim($newline[0]);	
}

#duracion
if(strlen($codigo)>strlen(str_replace('<input name="cur_duracion" type="text" class="campos" id="cur_duracion" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_duracion" type="text" class="campos" id="cur_duracion" value="');
$newline=explode('" size=',str_replace($quitosdecurso,'',$codigo))	;
$datos[duracion]=trim($newline[0]);	
}


#descripcion
if(strlen($codigo)>strlen(str_replace('<textarea name="cur_descripcion" cols="40" rows="3" class="campos" id="cur_descripcion" onKeyUp="javascript:cambios();">','',$codigo))){
$quitosdecurso=array('<textarea name="cur_descripcion" cols="40" rows="3" class="campos" id="cur_descripcion" onKeyUp="javascript:cambios();">');
$newline=explode('</t',str_replace($quitosdecurso,'',$codigo));
$datos[descripcion]=trim($newline[0]);	
}


#dirigidoa
if(strlen($codigo)>strlen(str_replace('<textarea name="cur_dirigidoa" cols="44" rows="3" class="campos" id="cur_dirigidoa" onKeyUp="javascript:cambios();">','',$codigo))){
$quitosdecurso=array('<textarea name="cur_dirigidoa" cols="44" rows="3" class="campos" id="cur_dirigidoa" onKeyUp="javascript:cambios();">');
$newline=explode('</t',str_replace($quitosdecurso,'',$codigo));
$datos[dirigidoa]=trim($newline[0]);	
}


#paraqueteprepara
if(strlen($codigo)>strlen(str_replace('<textarea name="cur_paraqueteprepara" cols="44" rows="3" class="campos" id="cur_paraqueteprepara" onKeyUp="javascript:cambios();">','',$codigo))){
$quitosdecurso=array('<textarea name="cur_paraqueteprepara" cols="44" rows="3" class="campos" id="cur_paraqueteprepara" onKeyUp="javascript:cambios();">');
$newline=explode('</t',str_replace($quitosdecurso,'',$codigo));
$datos[paraqueteprepara]=trim($newline[0]);	
}


#edadmin
if(strlen($codigo)>strlen(str_replace('<input id="cur_edadmin" name="cur_edadmin" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="','',$codigo))){
$quitosdecurso=array('<input id="cur_edadmin" name="cur_edadmin" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="');
$newline=explode('"',str_replace($quitosdecurso,'',$codigo));
$datos[edadmin]=trim($newline[0]);	
}


#edadmax
if(strlen($codigo)>strlen(str_replace('<input id="cur_edadmax" name="cur_edadmax" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="','',$codigo))){
$quitosdecurso=array('<input id="cur_edadmax" name="cur_edadmax" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="');
$newline=explode('"',str_replace($quitosdecurso,'',$codigo));
$datos[edadmax]=trim($newline[0]);	
}




#dondeseimparte
if(strlen($codigo)>strlen(str_replace('<select name="dondeimparte[]" size="4" multiple class="campos" id="dondeimparte" onchange="javascript:cambios();">','',$codigo))){$loopdonde=1;};
if(strlen($codigo)>strlen(str_replace('</select>','',$codigo))){$loopdonde=0;}
if($loopdonde){
if(strlen($codigo)>strlen(str_replace('selected','',$codigo))){
$newline=explode('"',str_replace($quitosdecurso,'',$codigo))	;
$prosede=$eqip_of_seek[trim($newline[1])];



$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

$queryp= "SELECT cp from skv_sedes where cp like '$prosede%' and idcentro=$idcentseek;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$datos[dondeseimparte][]=$row[cp];};			

if (!$dbnivel->close()){die($dbnivel->error());};	






}}



}


$lineas=array();
$c = curl_init("http://procenet:nuevaof21@82.223.155.233:81/temariopopup.php?iddelcentro=$idc&idcurso=$idcur");
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=explode("\n",$data); 


foreach ($lineas as $pointer => $codigo){
			
		
	
#temario
if(strlen($codigo)>strlen(str_replace('<textarea name="cur_temario" rows="4" cols="40" style="width: 385px; height: 320px">','',$codigo))){$looptemario=1;};
if(strlen($codigo)>strlen(str_replace('</textarea>','',$codigo))){$looptemario=0;};
if($looptemario){
$datos[temario].=htmlspecialchars_decode($codigo);
}



}	

$quitos=array(
'<span style="FONT-FAMILY: Arial; COLOR: #333399">',
'<o:p>','</o:p>','</span>',
'<font face="Times New Roman" color="#000000" size="3">','</font>','<font color="#000000" size="3" face="Times New Roman">','<textarea name="cur_temario" rows="4" cols="40" style="width: 385px; height: 320px">');
$datos[temario]=str_replace($quitos,'',$datos[temario]);
$datos[temario]=str_replace('><',">\n<",$datos[temario]);
$datos[temario]=str_replace('< /',"</",$datos[temario]);

$codOLD=array(
'<strong style="mso-bidi-font-weight: normal">','<strong>','</strong>','</p>','<p>','</br>','<br />','<p class="MsoNormal">','<em>','</em>'
);
$codNEW=array(
"[str]","[str]","[|str]\n","\n[|p]\n","\n[p]\n","[|br]\n","[|br]\n","\n[p]\n","\n[em]\n","\n[|em]\n"
);

$datos[temario]=str_replace($codOLD,$codNEW,$datos[temario]);
#$datos[temario]=strip_tags($datos[temario]);
$datos[temario]=html_entity_decode($datos[temario]);






$lineas=array();
$c = curl_init("http://procenet:nuevaof21@82.223.155.233:81/categoriza.php?iddelcentro=$idc&idcurso=$idcur");
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=explode("\n",$data); 


foreach ($lineas as $pointer => $codigo){
			
		
	
#categoria
if(strlen($codigo)>strlen(str_replace('checked','',$codigo))){
$quitosdecurso=array('<input name="idcatselect" type="radio" value="');
$newline=explode('"',str_replace($quitosdecurso,'',$codigo));
$datos[idcategoria]=trim($newline[0]);	
}



}	



$lineas=array();
$c = curl_init("http://procenet:nuevaof21@82.223.155.233:81/palclave.php?iddelcentro=$idc&idcurso=$idcur");
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=explode("\n",$data); 


foreach ($lineas as $pointer => $codigo){
			
		
	
#palclave

if(strlen($codigo)>strlen(str_replace('<textarea name="palabrasclave" cols="83" rows="2" class="campos" id="palabrasclave" onKeyUp="javascript:cambios();">','',$codigo))){
$quitosdecurso=array('<textarea name="palabrasclave" cols="83" rows="2" class="campos" id="palabrasclave" onKeyUp="javascript:cambios();">');
$newline=explode('</t',str_replace($quitosdecurso,'',$codigo));
$datos[palclave]=trim($newline[0]);	
}



}	

return $datos;
}




function BuscoMismoCurso($datos,$idcentseek){
global $conf;global $idequi_idtipcur_ofer_seek;global $idequi_idmet_ofer_seek;
echo "Busco el curso del que es duplicado \n";	

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

$idp=$datos[idcurpropio];$cod1=$datos[cod1];$cod2=$datos[cod2];
$nombrecur=addslashes($datos[nomcursoalt]);
$nombrecur_old=addslashes($datos[nomcurso]);
$id_tipo_curso=$idequi_idtipcur_ofer_seek[$datos[idtipocurso]];
$id_metodo=$idequi_idmet_ofer_seek[$datos[idmetodo]];


$query1= "select id from skv_cursos where 
id_centro=$idcentseek AND 
cur_id_curso_propio='$idp' AND 
cur_otro_codigo1='$cod1' AND 
cur_otro_codigo2='$cod2';";

$query2= "select id from skv_cursos where 
id_centro=$idcentseek AND 
nombre like '$nombrecur' AND cur_id_metodo=$id_metodo;";

if(!$idcursoyainsertado){$dbnivel->query($query1);};
while ($row = $dbnivel->fetchassoc()){$idcursoyainsertado=$row['id'];};

if(!$idcursoyainsertado){$dbnivel->query($query2);};
while ($row = $dbnivel->fetchassoc()){$idcursoyainsertado=$row['id'];};



return $idcursoyainsertado;


}




function InsertaDatosGlobales($datos,$idcentseek,$idcurofe){
global $conf;global $idequi_idtipcur_ofer_seek;global $idequi_idmet_ofer_seek;

echo "Creo un curso nuebo con sus datos globales \n";		

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

$idp=$datos[idcurpropio];$cod1=$datos[cod1];$cod2=$datos[cod2];
$nombrecur=addslashes($datos[nomcursoalt]);
$nombrecur_old=addslashes($datos[nomcurso]);
$id_tipo_curso=$idequi_idtipcur_ofer_seek[$datos[idtipocurso]];
$id_metodo=$idequi_idmet_ofer_seek[$datos[idmetodo]];
$cur_titoficial=addslashes($datos[titoficial]);
$cur_precio=addslashes($datos[precio]);
$cur_mostrarprecio=addslashes($datos[m_precio]);
$cur_facilidad=addslashes($datos[facilidades]);
$cur_practicas=addslashes($datos[practicas]);
$cur_otrosdatos=addslashes($datos[otrosdatos]);
$cur_duracion=addslashes($datos[duracion]);
$cur_descripcion=addslashes($datos[descripcion]);
$cur_dirigidoa=addslashes($datos[dirigidoa]);
$cur_paraqueteprepara=addslashes($datos[paraqueteprepara]);
$cur_edadmin=addslashes($datos[edadmin]);
$cur_edadmax=addslashes($datos[edadmax]);
$temario=addslashes($datos[temario]);
$cur_id_certificado=$datos[idcertificado];
$cur_palclave=addslashes($datos[palclave]);
$cur_minestudi=$datos[idstudiomin];
$cur_cat=$datos[idcategoria];



$queryp= "INSERT INTO skv_cursos (
id_centro, 
id_old, 
nombre, 
nombre_viejo, 
cur_id_curso_propio, 
cur_otro_codigo1, 
cur_otro_codigo2, 
cur_id_tipocurso, 
cur_id_metodo, 
cur_titoficial, 
cur_precio, 
cur_mostarprecio, 
cur_facilidad, 
cur_practicas, 
cur_otrosdatos, 
cur_duracion, 
cur_descripcion, 
cur_dirigidoa, 
cur_paraqueteprepara, 
cur_edadmin, 
cur_edadmax, 
temario, 
cur_id_certificado, 
cur_palclave, 
cur_minestudi, 
cur_cat
) VALUES (
$idcentseek,
$idcurofe,
'$nombrecur',
'$nombrecur_old',
'$idp',
'$cod1',
'$cod2',
$id_tipo_curso,
$id_metodo,
'$cur_titoficial',
'$cur_precio',
$cur_mostrarprecio,
'$cur_facilidad',
'$cur_practicas',
'$cur_otrosdatos',
'$cur_duracion',
'$cur_descripcion',
'$cur_dirigidoa',
'$cur_paraqueteprepara',
'$cur_edadmin',
'$cur_edadmax',
'$temario',
'$cur_id_certificado',
'$cur_palclave',
'$cur_minestudi',
'$cur_cat'
);";

$dbnivel->query($queryp);
echo $queryp;
$queryp= "SELECT LAST_INSERT_ID() as id;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idnew=$row['id'];};

return $idnew;

}


function Inserto_provis($provis,$newIdcur){
global $conf;
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};		

if(count($provis)>0){
foreach ($provis as $pointer => $idpro) {
$id=0;			
$queryp= "SELECT id from skv_relCurPro where idcur=$newIdcur AND idpro=$idpro;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$id=$row['id'];};		
if(!$id){	
$queryp= "INSERT INTO skv_relCurPro (idcur,idpro) VALUES ($newIdcur,$idpro)";
$dbnivel->query($queryp);	
}
}}

if (!$dbnivel->close()){die($dbnivel->error());};	
}









######################################
#####################################
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
	
$queryp= "SELECT idofer, idcur, idseek from import_cursos_si where ok_temp=0 limit 1;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idc=$row['idofer'];$idcur=$row['idcur'];$idcentseek=$row[idseek];};			

$queryp= "SELECT id_old from skv_centros where id=$idcentseek;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idofetainsertado=$row['id_old'];};			

echo "Id ofertade este curso :$idc id ya insertado: $idofetainsertado IDseekdefinitivo:$idcentseek \n";


if (!$dbnivel->close()){die($dbnivel->error());};	

######################################
#####################################



$datos=datoscurso($idc,$idcur,$idcentseek);####### Obtengo los datos
utf8_encode_deep($datos);

######################################
##################################### INSERCION DE DATOS
$fusionado=0;
if($idc != $idofetainsertado){$fusionado=1;};



if($fusionado)					{$newIdcur=BuscoMismoCurso($datos,$idcentseek);}else
								{$newIdcur=InsertaDatosGlobales($datos,$idcentseek,$idcur);};
if(!$newIdcur)					{$newIdcur=InsertaDatosGlobales($datos,$idcentseek,$idcur);};




 if($newIdcur){

Inserto_provis($datos[dondeseimparte],$newIdcur);
echo $newIdcur;	

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "UPDATE import_cursos_si SET ok_temp=1 where idofer=$idc and idcur=$idcur;";
$dbnivel->query($queryp);
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
<body onload="JavaScript:timedRefresh(120);">
<p>
';
echo "------------------------------------ \n";
echo "http://82.223.155.233:81/fichacurso.php?iddelcentro=$idc&idcurso=$idcur";
echo "\n\n------------------------------------ \n\n\n";
echo '
</p>
</body>
</html>

';



}


#print_r($datos);
#print_r($lineas);
?>