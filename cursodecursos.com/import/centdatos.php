<?php
include '../skin/variables.php';





function datos_centro($idc){
$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/centros-detalle1.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 





foreach ($lineas as $pointer => $codigo){

#nombre del centro
if(strlen($codigo)>strlen(str_replace('name="nombre"','',$codigo))){
$quitosdecurso=array('<input name="nombre" type="text" class="campos" id="nombredelcentro" value="','" size="57"  onKeyUp="javascript:cambios();">');
$datos[nomcentro]=trim(str_replace($quitosdecurso,'',$codigo));	
}

#descripcion del centro
if(strlen($codigo)>strlen(str_replace('name="descripcion"','',$codigo))){
$quitosdecurso=array('<textarea name="descripcion" cols="57" rows="3" class="campos" id="descripciondelcentro"  onKeyUp="javascript:cambios();">','</textarea>');
$datos[descripcion]=trim(str_replace($quitosdecurso,'',$codigo));	
}


#web del centro
if(strlen($codigo)>strlen(str_replace('id="webdelcentro','',$codigo))){
$quitosdecurso=array('<input name="web" type="text" class="campos" id="webdelcentro" value="','" size="44"  onKeyUp="javascript:cambios();">');
$datos[web]=trim(str_replace($quitosdecurso,'',$codigo));	
}



#telefono del centro
if(strlen($codigo)>strlen(str_replace('id="telefono','',$codigo))){
$quitosdecurso=array('<input name="telefono" type="text" class="campos" id="telefono" value="','" size="8" onKeyUp="javascript:cambios();">');
$datos[tlf]=trim(str_replace($quitosdecurso,'',$codigo));	
}


}


$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/centros-tipocentro.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 


foreach ($lineas as $pointer => $codigo){

#tipo de centro
if(strlen($codigo)>strlen(str_replace('checked','',$codigo))){
$quitosdecurso=array('<input name="tipodecentro" type="radio" value="','" checked onclick="javascript:cambiosradio(\'tipodecentro\',\'academia\');cambio2();cambios();">');
$datos[tipocent]=trim(str_replace($quitosdecurso,'',$codigo));	
}

}










############## listado de sedes
$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/centros-listasedes.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 


foreach ($lineas as $pointer => $codigo){

#id sedes
if(strlen($codigo)>strlen(str_replace('javascript:borrasede','',$codigo))){
$quitosdecurso=array('<a href="#" onclick="javascript:borrasede(\'' . $idc . "','" ,'\')">');
$datos[sedes][trim(str_replace($quitosdecurso,'',$codigo))][nomsede]=0;	
}

}



foreach ($datos[sedes] as $idsede => $value) {

$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/centros-fichasede.php?idsede=' . $idsede);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 


foreach ($lineas as $pointer => $codigo){

#nombre sede
if(strlen($codigo)>strlen(str_replace('name="sede"','',$codigo))){
$quitosdecurso=array('<input name="sede" type="text" class="campos" id="sede" value="','" size="12">');
$datos[sedes][$idsede][nomsede]=trim(str_replace($quitosdecurso,'',$codigo));	
}
# cp
if(strlen($codigo)>strlen(str_replace('name="cp"','',$codigo))){
$quitosdecurso=array('<input name="cp" type="text" class="campos" value="','" size="3">');
$datos[sedes][$idsede][cp]=trim(str_replace($quitosdecurso,'',$codigo));	
}
# direccion
if(strlen($codigo)>strlen(str_replace('name="direccion"','',$codigo))){
$quitosdecurso=array('<input name="direccion" type="text" class="campos" value="','" size="34">');
$datos[sedes][$idsede][direccion]=trim(str_replace($quitosdecurso,'',$codigo));	
}

# poblacion
if(strlen($codigo)>strlen(str_replace('name="poblacion"','',$codigo))){
$quitosdecurso=array('<input name="poblacion" type="text" class="campos" value="','" size="20">');
$datos[sedes][$idsede][poblacion]=trim(str_replace($quitosdecurso,'',$codigo));	
}


}
#break;
}


#contactos
$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/centros-listacontactos.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 


foreach ($lineas as $pointer => $codigo){
$lineanew=array();
$codigo=trim($codigo);
#nombre idcontacto
if(strlen($codigo)>strlen(str_replace('<tr class="listadopar" id="','',$codigo))){
$quitosdecurso=array('<tr class="listadopar" id="');
$lineanew=explode('"', str_replace($quitosdecurso,'',$codigo) ); $idcont=$lineanew[0];
$datos[contactos][$idcont][id]=$idcont;	
}


if(strlen($codigo)>strlen(str_replace('<td width="215" align="left"','',$codigo))){
$quitosdecurso=array('<td width="215" align="left" onClick="javaescript:recargafichacontacto(' . $idcont . ',\'' . $idc . '\');">','</td>');
$datos[contactos][$idcont][nomcont]=trim(str_replace($quitosdecurso,'',$codigo));		
}

if(strlen($codigo)>strlen(str_replace('<td width="62" align="left"','',$codigo))){
$quitosdecurso=array('<td width="62" align="left" onClick="javaescript:recargafichacontacto(' . $idcont . ',\'' . $idc . '\');">','</td>');
$datos[contactos][$idcont][telcont]=trim(str_replace($quitosdecurso,'',$codigo));		
}

if(strlen($codigo)>strlen(str_replace('<td width="101" align="left"','',$codigo))){
$quitosdecurso=array('<td width="101" align="left" onClick="javaescript:recargafichacontacto(' . $idcont . ',\'' . $idc . '\');">','</td>');
$datos[contactos][$idcont][mailcont]=trim(str_replace($quitosdecurso,'',$codigo));		
}

}

#campos
$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/listadocampos.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 


foreach ($lineas as $pointer => $codigo){
$lineanew=array();
$codigo=trim($codigo);

#nombre idcontacto
if(strlen($codigo)>strlen(str_replace('<tr align="center" class="listadopar" id="','',$codigo))){
$quitosdecurso=array('<tr align="center" class="listadopar" id="');
$lineanew=explode('"', str_replace($quitosdecurso,'',$codigo) ); $idcont=$lineanew[0];
$datos[campos][$idcont][id]=$idcont;$datos[campos][$idcont][obligado]=0;	
}


if(strlen($codigo)>strlen(str_replace('*','',$codigo))){
$datos[campos][$idcont][obligado]=1;		
}

if(strlen($codigo)>strlen(str_replace('<td width="110" align="left"','',$codigo))){
$quitosdecurso=array('<td width="110" align="left" onClick="javaescript:recargafichacampo(' . $idcont . ',\'' . $idc . '\');">','</td>');
$datos[campos][$idcont][]=trim(str_replace($quitosdecurso,'',$codigo));		
}

}


$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/urlscript.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 


foreach ($lineas as $pointer => $codigo){

#URL
if(strlen($codigo)>strlen(str_replace('name="url"','',$codigo))){
$quitosdecurso=array('<input name="url" id="url" type="text" class="campos" value="','" size="70" onKeyUp="javascript:cambio3();"> </td>');
$datos[urlpixel]=trim(str_replace($quitosdecurso,'',$codigo));	
}

}




$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/geoporcentro.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=split("\n",$data); 


foreach ($lineas as $pointer => $codigo){
$codigo=str_replace('<img src="/images/pixel.gif" width="3" height="15"> ','', $codigo);
#provincias perfil
if(strlen($codigo)>strlen(str_replace('onClick="javascript:relojespera()">','',$codigo))){
$newlin=explode('"', $codigo);$codigo=$newlin[1];$newlin2=explode('&', $codigo);$codigo=str_replace('eliminapro=', '', $newlin2[3]);
$datos[provisperfil][]=$codigo;
}

if(strlen($codigo)>strlen(str_replace('onClick="javascript:ocultafiltro2()" checked','',$codigo))){
$datos[provisperfil][act]=1;
}

if(strlen($codigo)>strlen(str_replace('onClick="javascript:centaplicoatodos()" checked','',$codigo))){
$datos[provisperfil][tod]=1;
}

}


return $datos;
}


function insterta_centro($datos){
global $conf;
print_r($conf);
#$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
#if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "INSERT INTO skv_centros (id_old,nombre,descripcion,web,telefono,tipocentro,urlpixel,ext_logo) VALUES (" . $datos['idc'] . ",'" . $datos['nomcentro'] . "','" . $datos['descripcion'] . "','" . $datos['web'] . "','" . $datos['tlf'] . "','" . $datos['tipocent'] . "','" . $datos['urlpixel'] . "','gif');";
echo $queryp;
#$dbnivel->query($queryp);
#if (!$dbnivel->close()){die($dbnivel->error());};				
					
				
 		
		
	
}





$idc=939;
#$datos=datos_centro($idc);
$datos['idc']=$idc;

insterta_centro($datos);





print_r($datos);
#print_r($lineas);

?>