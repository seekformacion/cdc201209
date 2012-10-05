<?php
set_time_limit(0);
include "../scripts/variables.php";


$eqip_of_seek[115]="15";
$eqip_of_seek[114]="03";
$eqip_of_seek[83]="01";
$eqip_of_seek[116]="02";
$eqip_of_seek[117]="04";
$eqip_of_seek[118]="33";
$eqip_of_seek[84]="05";
$eqip_of_seek[105]="06";
$eqip_of_seek[113]="07";
$eqip_of_seek[104]="08";
$eqip_of_seek[103]="09";
$eqip_of_seek[102]="10";
$eqip_of_seek[101]="11";
$eqip_of_seek[109]="39";
$eqip_of_seek[119]="12";
$eqip_of_seek[134]="51";
$eqip_of_seek[112]="13";
$eqip_of_seek[120]="14";
$eqip_of_seek[100]="16";
$eqip_of_seek[111]="17";
$eqip_of_seek[121]="18";
$eqip_of_seek[99]="19";
$eqip_of_seek[98]="20";
$eqip_of_seek[122]="21";
$eqip_of_seek[97]="22";
$eqip_of_seek[110]="23";
$eqip_of_seek[123]="26";
$eqip_of_seek[132]="35";
$eqip_of_seek[124]="24";
$eqip_of_seek[85]="25";
$eqip_of_seek[125]="27";
$eqip_of_seek[126]="28";
$eqip_of_seek[127]="29";
$eqip_of_seek[133]="52";
$eqip_of_seek[128]="30";
$eqip_of_seek[96]="31";
$eqip_of_seek[86]="32";
$eqip_of_seek[129]="34";
$eqip_of_seek[95]="36";
$eqip_of_seek[94]="37";
$eqip_of_seek[130]="38";
$eqip_of_seek[131]="40";
$eqip_of_seek[93]="41";
$eqip_of_seek[92]="42";
$eqip_of_seek[108]="43";
$eqip_of_seek[91]="44";
$eqip_of_seek[90]="45";
$eqip_of_seek[107]="46";
$eqip_of_seek[87]="47";
$eqip_of_seek[106]="48";
$eqip_of_seek[89]="49";
$eqip_of_seek[88]="50";	
	
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
	
$queryp= "SELECT idofer, idcur, idseek from import_cursos_si where ok_temp=0 limit 1;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idc=$row['idofer'];$idcur=$row['idcur'];$idcentseek=$row[idseek];};			


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


$finnom=1000;
if( (strpos($datos[nomcurso],' -')<$finnom) && (strpos($datos[nomcurso],' -')>0) ){$finnom=strpos($datos[nomcurso],' -');};
if( (strpos($datos[nomcurso],' (')<$finnom) && (strpos($datos[nomcurso],' (')>0) ){$finnom=strpos($datos[nomcurso],' (');};

$datos[nomcursoalt]=substr($datos[nomcurso],0,$finnom*1);


echo $finnom;

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





print_r($datos);
print_r($lineas);
?>