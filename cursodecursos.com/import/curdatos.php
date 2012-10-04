<?php
set_time_limit(0);
include "../scripts/variables.php";


	
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
	
$queryp= "SELECT idofer, idcur from import_cursos_si where ok_temp=0 limit 1;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idc=$row['idofer'];$idcur=$row['idcur'];};			


$queryp= "UPDATE import_cursos_si SET ok_temp=1 where idofer=$idc and idcur=$idcur;";
$dbnivel->query($queryp);
	
if (!$dbnivel->close()){die($dbnivel->error());};	



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
$datos[dondeseimparte][]=trim($newline[1]);
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
'<strong>','</strong>','</p>','<p>','</br>','<br />','<p class="MsoNormal">','<em>','</em>'
);
$codNEW=array(
"[str]","[|str]\n","\n[|p]\n","\n[p]\n","[|br]\n","[|br]\n","\n[p]\n","\n[em]\n","\n[|em]\n"
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





print_r($datos);
print_r($lineas);
?>