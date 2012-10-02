<?php
set_time_limit(0);

include "../scripts/variables.php";


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


function datos_centro($idc){
$lineas=array();
$c = curl_init('http://procenet:nuevaof21@82.223.155.233:81/centros-detalle1.php?idcentro=' . $idc);
curl_setopt($c, CURLOPT_VERBOSE, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);
$data=str_replace('><',">\n<",$page);
$lineas=explode("\n",$data); 




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
$lineas=explode("\n",$data); 


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
$lineas=explode("\n",$data); 


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
$lineas=explode("\n",$data); 


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
$lineas=explode("\n",$data); 


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
$lineas=explode("\n",$data); 


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
$lineas=explode("\n",$data); 


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
$lineas=explode("\n",$data); 


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


function inserta_sedes($datos,$idseek){global $conf;
	
	
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
	
	foreach ($datos as $idsed => $valores) {
		 	$nomsede=$valores['nomsede'];
            $poblacion=$valores['poblacion'];
           	$cp=$valores['cp'];if(strlen($cp)==4){$cp="0" . $cp;};$idprovi=substr($cp,0,3);
            $direccion=$valores['direccion'];
			
	$queryp= "INSERT INTO skv_sedes 
	(idcentro,nombre,pais,provincia,poblacion,cp,direccion) 
	VALUES 
	($idseek,'$nomsede','8','$idprovi','$poblacion','$cp','$direccion');";
	
	$dbnivel->query($queryp);
	
	
	
	
	}

$queryp= "UPDATE import_centro SET sedes=1 where idseek=$idseek;";
$dbnivel->query($queryp);
	
if (!$dbnivel->close()){die($dbnivel->error());};	
	
}

function inserta_contactos($datos,$idseek){global $conf;
	
	
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
	
	
	foreach ($datos as $idsed => $valores) {
		 	$nomcont=$valores['nomcont'];
            $telcont=$valores['telcont'];
           	$mailcont=$valores['mailcont'];
			
	$queryp= "INSERT INTO skv_contactos 
	(idcentro,nombre,tlf,mail) 
	VALUES 
	($idseek,'$nomcont','$telcont','$mailcont');";
	
	$dbnivel->query($queryp);
	
	
	
	
	}

$queryp= "UPDATE import_centro SET contactos=1 where idseek=$idseek;";
$dbnivel->query($queryp);
	
if (!$dbnivel->close()){die($dbnivel->error());};	
	
}


function equicampo($value,$table,$campo){global $conf;

$id=0;

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT id from $table where $campo='$value';";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$id=$row['id'];};		

if(!$id){
$queryp= "INSERT into $table ($campo) values ('$value');";
$dbnivel->query($queryp);
$queryp= "SELECT LAST_INSERT_ID() as id;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$id=$row['id'];};
}
if (!$dbnivel->close()){die($dbnivel->error());};
return $id;
}



function inserta_campos($datos,$idseek){global $conf;
	
	foreach ($datos as $idsed => $valores) {
		 	$camp=$valores[0];
           	$idcampo=equicampo($camp,'skv_campos','nom_campo');	
			$datos[$idsed]['idcampo']=$idcampo;
			}

	$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
	if (!$dbnivel->open()){die($dbnivel->error());};
		
	foreach ($datos as $idsed => $valores) {
		 	$ob=$valores['obligado'];
            $camp=$valores[0];
           	$most=$valores[1];
			$equi=$valores[2];
			$idcampo=$valores['idcampo'];
	
	
		
	$queryp= "INSERT INTO skv_relCampos 
	(id_centro,idcampo,muestro,bd,obligado) 
	VALUES 
	($idseek,'$idcampo','$most','$equi','$ob');";
	
	$dbnivel->query($queryp);

	}

$queryp= "UPDATE import_centro SET campos=1 where idseek=$idseek;";
$dbnivel->query($queryp);
	
if (!$dbnivel->close()){die($dbnivel->error());};	
	
}








function insterta_centro($datos){
global $conf;		
	

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "INSERT INTO skv_centros (id_old,nombre,descripcion,web,telefono,tipocentro,urlpixel,ext_logo) VALUES (" . $datos['idc'] . ",'" . $datos['nomcentro'] . "','" . $datos['descripcion'] . "','" . $datos['web'] . "','" . $datos['tlf'] . "','" . $datos['tipocent'] . "','" . $datos['urlpixel'] . "','gif');";
$dbnivel->query($queryp);

$queryp= "SELECT LAST_INSERT_ID() as id;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idseek=$row['id'];};
$queryp= "INSERT INTO import_centro (idofer,idseek,datos) values (". $datos['idc'] . ",$idseek,1);";
$dbnivel->query($queryp);




if (!$dbnivel->close()){die($dbnivel->error());};				
					
inserta_sedes($datos['sedes'], $idseek);		
inserta_contactos($datos['contactos'], $idseek);	
inserta_campos($datos['campos'], $idseek);		
		
	
}




$idc=939;

$datos=datos_centro($idc);
$datos['idc']=$idc;
utf8_encode_deep($datos);
insterta_centro($datos);



#echo exif_imagetype('http://procenet:nuevaof21@82.223.155.233:81/logos.php?tipo=g&idcentro=939');
#print_r($datos);

?>