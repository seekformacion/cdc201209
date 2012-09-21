<?php




function getCursos($url){

$data = file_get_contents($url,0);
$lineas=split("\n",$data); 

$start=0;   
foreach ($lineas as $numlinea => $codigo){

if(strlen($codigo)>strlen(str_replace('cajacursolistado_2','',$codigo))){$start=1;$counter++;};

if($start){$valores[$counter][]=$codigo;};

if(strlen($codigo)>strlen(str_replace('CajaBordeNegro','',$codigo))){$start=0;};


}


foreach ($valores as $pointer => $linea){
$quitosdecurso=array('<div id="','" class="cajacursolistado_2">');
$idcurso=str_replace($quitosdecurso,'',$linea[0]);

$quitosdecentro=array('<td><a href="','"><img src="/logosp/','.gif" alt="','" title="','" width="100" height="50" border="0" class="CajaBordeNegro"></a></td>');
$centros=split(',',str_replace($quitosdecentro,',',$linea[5]));

$cursos[$idcurso]=$centros[2];
}

return $cursos;
}







function getDatosCurso($idcentro,$idcurso){
global $result;
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/fichacurso.php?iddelcentro=' . $idcentro . '&idcurso=' . $idcurso);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);


$page = curl_exec($c);

#print "<pre>\n";
#print_r(curl_getinfo($c));  // get error info
#echo "\n\ncURL error number:" .curl_errno($c); // print error info
#echo "\n\ncURL error:" . curl_error($c); 
#print "</pre>\n";

curl_close($c);


$data=str_replace('><',">\n<",$page);

$lineas=split("\n",$data); 


#print_r($lineas);

foreach ($lineas as $numlinea => $codigo){

###### titulo del curso
if(strlen($codigo)  > strlen(str_replace('<input name="cur_nombre" type="text" class="campos" id="cur_nombre" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_nombre" type="text" class="campos" id="cur_nombre" value="','" size="70" onKeyUp="javascript:cambios();cambiotitulo();">Id_Curso_Propio:<span class="Titulo7">');
$tituloCurso=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][Titulo]=$tituloCurso;
}


###### cur_id_curso_propio
if(strlen($codigo)  > strlen(str_replace('<input name="cur_id_curso_propio" type="text" class="campos" id="cur_id_curso_propio" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_id_curso_propio" type="text" class="campos" id="cur_id_curso_propio" value="','" size="4" onKeyUp="javascript:cambios();">');
$cur_id_curso_propio=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_id_curso_propio]=$cur_id_curso_propio;
}

###### cur_otro_codigo1
if(strlen($codigo)  > strlen(str_replace('<input name="cur_otro_codigo1" type="text" class="campos" id="cur_otro_codigo1" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_otro_codigo1" type="text" class="campos" id="cur_otro_codigo1" value="','" size="4" onKeyUp="javascript:cambios();">');
$cur_otro_codigo1=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_otro_codigo1]=$cur_otro_codigo1;
}

###### cur_otro_codigo2
if(strlen($codigo)  > strlen(str_replace('<input name="cur_otro_codigo2" type="text" class="campos" id="cur_otro_codigo2" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_otro_codigo2" type="text" class="campos" id="cur_otro_codigo2" value="','" size="4" onKeyUp="javascript:cambios();">');
$cur_otro_codigo2=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_otro_codigo2]=$cur_otro_codigo2;
}

###### cur_posidelcurso
if(strlen($codigo)  > strlen(str_replace('</span> POS:<input name="cur_posidelcurso" id="cur_posidelcurso" type="text" value="','',$codigo))){
$quitosdecurso=array('</span> POS:<input name="cur_posidelcurso" id="cur_posidelcurso" type="text" value="','" size="3" onKeyUp="javascript:cambios();" class="campos">');
$cur_posidelcurso=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_posidelcurso]=$cur_posidelcurso;
}

###### cur_id_tipocurso
if(($tipocurso==1)&&(strlen($codigo)  > strlen(str_replace('</select>','',$codigo)))){$tipocurso=0;echo $temariotxt;};
if($tipocurso==1){
	if(strlen($codigo)  > strlen(str_replace('selected','',$codigo))){
		$opciones=split('" selected>',$codigo);
		$cur_id_tipocurso=str_replace('<option value="','',$opciones[0]);
		$result[$idcurso][cur_id_tipocurso]=$cur_id_tipocurso;
	}	
}
if(strlen($codigo)  > strlen(str_replace('<select name="cur_id_tipocurso"','',$codigo))){$tipocurso=1;};



###### cur_id_metodo
if(($metodo==1)&&(strlen($codigo)  > strlen(str_replace('</select>','',$codigo)))){$metodo=0;echo $temariotxt;};
if($metodo==1){
	if(strlen($codigo)  > strlen(str_replace('selected','',$codigo))){
		$opciones=split('" selected>',$codigo);
		$cur_id_metodo=str_replace('<option value="','',$opciones[0]);
		$result[$idcurso][cur_id_metodo]=$cur_id_metodo;
	}	
}
if(strlen($codigo)  > strlen(str_replace('<select name="cur_id_metodo"','',$codigo))){$metodo=1;};



###### cur_id_certificado
if(($certificado==1)&&(strlen($codigo)  > strlen(str_replace('</select>','',$codigo)))){$certificado=0;};
if($certificado==1){
	if(strlen($codigo)  > strlen(str_replace('selected','',$codigo))){
		$opciones=split('" selected>',$codigo);
		$cur_id_certificado=str_replace('<option value="','',$opciones[0]);
		$result[$idcurso][cur_id_certificado]=$cur_id_certificado;
	}	
}
if(strlen($codigo)  > strlen(str_replace('<select name="cur_id_certificado"','',$codigo))){$certificado=1;};



###### cur_titoficial
if(strlen($codigo)  > strlen(str_replace('<input name="cur_titoficial" type="text" class="campos" id="cur_titoficial" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_titoficial" type="text" class="campos" id="cur_titoficial" value="','" size="50" onKeyUp="javascript:cambios();">');
$cur_titoficial=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_titoficial]=$cur_titoficial;
}



###### cur_id_nivelestudios
if(($nivelestudios==1)&&(strlen($codigo)  > strlen(str_replace('</select>','',$codigo)))){$nivelestudios=0;};
if($nivelestudios==1){
	if(strlen($codigo)  > strlen(str_replace('selected','',$codigo))){
		$opciones=split('" selected>',$codigo);
		$cur_id_nivelestudios=str_replace('<option value="','',$opciones[0]);
		$result[$idcurso][cur_id_nivelestudios]=$cur_id_nivelestudios;
	}	
}
if(strlen($codigo)  > strlen(str_replace('<select name="cur_id_nivelestudios"','',$codigo))){$nivelestudios=1;};



###### cur_precio
if(strlen($codigo)  > strlen(str_replace('<input name="cur_precio" type="text" class="campos" id="cur_precio" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_precio" type="text" class="campos" id="cur_precio" value="','" size="4" onKeyUp="javascript:cambios();">');
$cur_precio=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_precio]=$cur_precio;
}

###### cur_mostarprecio
if(strlen($codigo)  > strlen(str_replace('<input type="checkbox" name="cur_mostarprecio" id="cur_mostarprecio" value="','',$codigo))){
if(strlen($codigo)  > strlen(str_replace('checked','',$codigo))){$cur_mostarprecio=1;}else{$cur_mostarprecio=0;};
$result[$idcurso][cur_mostarprecio]=$cur_mostarprecio;
}


###### cur_facilidad
if(strlen($codigo)  > strlen(str_replace('<input name="cur_facilidad" type="text" class="campos" id="cur_facilidad" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_facilidad" type="text" class="campos" id="cur_facilidad" value="','" size="30" onKeyUp="javascript:cambios();">');
$cur_facilidad=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_facilidad]=$cur_facilidad;
}

###### cur_practicas
if(strlen($codigo)  > strlen(str_replace('<input name="cur_practicas" type="text" class="campos" id="cur_practicas" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_practicas" type="text" class="campos" id="cur_practicas" value="','" size="30" onKeyUp="javascript:cambios();">');
$cur_practicas=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_practicas]=$cur_practicas;
}


###### cur_otrosdatos
if(strlen($codigo)  > strlen(str_replace('<input name="cur_otrosdatos" type="text" class="campos" id="cur_otrosdatos" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_otrosdatos" type="text" class="campos" id="cur_otrosdatos" value="','" size="30" onKeyUp="javascript:cambios();">');
$cur_otrosdatos=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_otrosdatos]=$cur_otrosdatos;
}


###### cur_duracion
if(strlen($codigo)  > strlen(str_replace('<input name="cur_duracion" type="text" class="campos" id="cur_duracion" value="','',$codigo))){
$quitosdecurso=array('<input name="cur_duracion" type="text" class="campos" id="cur_duracion" value="','" size="4" onKeyUp="javascript:cambios();">                    </td>');
$cur_duracion=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_duracion]=$cur_duracion;
}



###### cur_descripcion
if(strlen($codigo)  > strlen(str_replace('<textarea name="cur_descripcion" cols="40" rows="3" class="campos" id="cur_descripcion" onKeyUp="javascript:cambios();">','',$codigo))){
$quitosdecurso=array('<textarea name="cur_descripcion" cols="40" rows="3" class="campos" id="cur_descripcion" onKeyUp="javascript:cambios();">','</textarea>');
$cur_descripcion=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_descripcion]=$cur_descripcion;
}


###### cur_dirigidoa
if(strlen($codigo)  > strlen(str_replace('<textarea name="cur_dirigidoa" cols="44" rows="3" class="campos" id="cur_dirigidoa" onKeyUp="javascript:cambios();">','',$codigo))){
$quitosdecurso=array('<textarea name="cur_dirigidoa" cols="44" rows="3" class="campos" id="cur_dirigidoa" onKeyUp="javascript:cambios();">','</textarea>');
$cur_dirigidoa=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_dirigidoa]=$cur_dirigidoa;
}

###### cur_paraqueteprepara
if(strlen($codigo)  > strlen(str_replace('<textarea name="cur_paraqueteprepara" cols="44" rows="3" class="campos" id="cur_paraqueteprepara" onKeyUp="javascript:cambios();">','',$codigo))){
$quitosdecurso=array('<textarea name="cur_paraqueteprepara" cols="44" rows="3" class="campos" id="cur_paraqueteprepara" onKeyUp="javascript:cambios();">','</textarea>');
$cur_paraqueteprepara=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_paraqueteprepara]=$cur_paraqueteprepara;
}




###### dondeimparte
if(($imparte==1)&&(strlen($codigo)  > strlen(str_replace('</select>','',$codigo)))){$imparte=0;};
if($imparte==1){
	if(strlen($codigo)  > strlen(str_replace('selected','',$codigo))){
		$opciones=split('" selected>',$codigo);
		$dondeimpartes[]=str_replace('<option value="','',$opciones[0]);
		$result[$idcurso][dondeimparte]=$dondeimpartes;
	}	
}
if(strlen($codigo)  > strlen(str_replace('<select name="dondeimparte[]"','',$codigo))){$imparte=1;};



###### cur_edadmin
if(strlen($codigo)  > strlen(str_replace('<input id="cur_edadmin" name="cur_edadmin" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="','',$codigo))){
$quitosdecurso=array('<input id="cur_edadmin" name="cur_edadmin" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="','">');
$cur_edadmin=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_edadmin]=$cur_edadmin;
}

###### cur_edadmax
if(strlen($codigo)  > strlen(str_replace('<input id="cur_edadmax" name="cur_edadmax" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="','',$codigo))){
$quitosdecurso=array('<input id="cur_edadmax" name="cur_edadmax" class="campos" type="text" size="4" onKeyUp="javascript:cambios();" value="','">');
$cur_edadmax=trim(str_replace($quitosdecurso,'',$codigo));
$result[$idcurso][cur_edadmax]=$cur_edadmax;
}


}

$datoscurso[$idcurso]=$result[$idcurso];
return $datoscurso;
}


function getTemarioCurso($idcentro,$idcurso){
global $result;

$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/temario.php?iddelcentro=' . $idcentro . '&idcurso=' . $idcurso);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);


$page = curl_exec($c);

#print "<pre>\n";
#print_r(curl_getinfo($c));  // get error info
#echo "\n\ncURL error number:" .curl_errno($c); // print error info
#echo "\n\ncURL error:" . curl_error($c); 
#print "</pre>\n";

curl_close($c);


$data=str_replace('><',">\n<",$page);

$lineas=split("\n",$data); 


#print_r($lineas);

foreach ($lineas as $numlinea => $codigo){

	
############ temario
if(($imparte==1)&&(strlen($codigo)  > strlen(str_replace("<script>parent.valorescambio.document.getElementById('primera').checked=true;</script>",'',$codigo)))){$imparte=0;};
if($imparte==1){	
	$result[$idcurso][temario] .=$codigo;
}
if(strlen($codigo)  > strlen(str_replace('<td colspan="2" class="Titulo1">','',$codigo))){$imparte=1;};
	


}



}




#print_r(getCursos("http://www.ofertaformativa.com/cursos_de_peluqueria.htm"));

global $result;
getDatosCurso('25268','811502');
getTemarioCurso('25268','811502');

print_r($result);
?>




