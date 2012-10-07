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
$newcode=explode('"',trim(str_replace($quitosdecurso,'',$codigo)));
$datos[tipocent]=$newcode[0];	
}

if(strlen($codigo)>strlen(str_replace('<input name="cent_tipodeformotros" type="text" class="campos" size="45" value="','',$codigo))){
$quitosdecurso=array('<input name="cent_tipodeformotros" type="text" class="campos" size="45" value="');
$newline=explode('"',str_replace($quitosdecurso,'',$codigo));
$otrotipocent=trim($newline[0]);	
if($otrotipocent){$datos[tipocent]=$otrotipocent;};
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


if(count($datos[sedes])>0){
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

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidñoooooouuuuy
bsaaaaaaaceeeeiiiidñoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}


function inserta_sedes($datos,$idseek){global $conf;


$pro_nom_seek['a coruña']=15;
$pro_nom_seek['alacant']=3;
$pro_nom_seek['alava']=1;
$pro_nom_seek['albacete']=2;
$pro_nom_seek['almeria']=4;
$pro_nom_seek['asturias']=33;
$pro_nom_seek['avila']=5;
$pro_nom_seek['badajoz']=6;
$pro_nom_seek['balears']=7;
$pro_nom_seek['barcelona']=8;
$pro_nom_seek['burgos']=9;
$pro_nom_seek['caceres']=10;
$pro_nom_seek['cadiz']=11;
$pro_nom_seek['cantabria']=39;
$pro_nom_seek['castello']=12;
$pro_nom_seek['ceuta']=51;
$pro_nom_seek['ciudad real']=13;
$pro_nom_seek['cordoba']=14;
$pro_nom_seek['cuenca']=16;
$pro_nom_seek['girona']=17;
$pro_nom_seek['granada']=18;
$pro_nom_seek['guadalajara']=19;
$pro_nom_seek['guipuzcoa']=20;
$pro_nom_seek['huelva']=21;
$pro_nom_seek['huesca']=22;
$pro_nom_seek['jaen']=23;
$pro_nom_seek['la rioja']=26;
$pro_nom_seek['las palmas']=35;
$pro_nom_seek['leon']=24;
$pro_nom_seek['lleida']=25;
$pro_nom_seek['lugo']=27;
$pro_nom_seek['madrid']=28;
$pro_nom_seek['malaga']=29;
$pro_nom_seek['melilla']=52;
$pro_nom_seek['murcia']=30;
$pro_nom_seek['navarra']=31;
$pro_nom_seek['ourense']=32;
$pro_nom_seek['palencia']=34;
$pro_nom_seek['pontevedra']=36;
$pro_nom_seek['salamanca']=37;
$pro_nom_seek['santa cruz de tenerife']=38;
$pro_nom_seek['segovia']=40;
$pro_nom_seek['sevilla']=41;
$pro_nom_seek['soria']=42;
$pro_nom_seek['tarragona']=43;
$pro_nom_seek['teruel']=44;
$pro_nom_seek['toledo']=45;
$pro_nom_seek['valencia']=46;
$pro_nom_seek['valladolid']=47;
$pro_nom_seek['vizcaya']=48;
$pro_nom_seek['zamora']=49;
$pro_nom_seek['zaragoza']=50;

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
	
	foreach ($datos as $idsed => $valores) {
		 	$nomsede=$valores['nomsede'];
            $poblacion=$valores['poblacion'];
			
			
           	$cp=$valores['cp'];
           	
           	if(!$cp){
           		
			$arraynom=explode("(",$nomsede);
			$nomcp=trim($arraynom[0]);	
			$cp=$pro_nom_seek[strtolower(normaliza($nomcp))];	
			if ($cp<10){$cp="0" .$cp;}$cp .="000";
		}
           	
           	if(strlen($cp)<5){$cp="0" . $cp;};$idprovi=substr($cp,0,3);
            $direccion=$valores['direccion'];
			
		$idcheck="";	
	$queryp= "SELECT id from skv_sedes where idcentro=$idseek and cp=$cp;";
	$dbnivel->query($queryp);
	while ($row = $dbnivel->fetchassoc()){$idcheck=$row['id'];};		
			
	$queryp= "INSERT INTO skv_sedes 
	(idcentro,nombre,pais,provincia,poblacion,cp,direccion) 
	VALUES 
	($idseek,'$nomsede','8','$idprovi','$poblacion','$cp','$direccion');";
	
	if(!$idcheck){$dbnivel->query($queryp);};
	
	
	
	
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
$queryp= "SELECT idofer, idfusion from import_listcentros_a_importar where idofer=" . $datos['idc'] .";";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idfusion=$row['idfusion'];$ids=$row['idseek'];};		
$Idofe=$datos['idc'];
if($idfusion){
	
		
	$datos['idc']=$idfusion;
	
$queryp= "SELECT id from skv_centros where id_old=" . $datos['idc'] .";";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$ids=$row['id'];};	
	
	$idseek=$ids;
}else{


$queryp= "INSERT INTO skv_centros (id_old,nombre,descripcion,web,telefono,tipocentro,urlpixel,ext_logo) VALUES (" . $datos['idc'] . ",'" . addslashes($datos['nomcentro']) . "','" . addslashes($datos['descripcion']) . "','" . $datos['web'] . "','" . $datos['tlf'] . "','" . $datos['tipocent'] . "','" . $datos['urlpixel'] . "','gif');";
$dbnivel->query($queryp);
$falla=$queryp;

$queryp= "SELECT LAST_INSERT_ID() as id;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idseek=$row['id'];};
}

if(!$idseek){
echo $falla;$fallo=1;
print_r($datos);
}else{
$queryp= "INSERT INTO import_centro (idofer,idseek,datos) values (". $Idofe . ",$idseek,1);";
$dbnivel->query($queryp);




if (!$dbnivel->close()){die($dbnivel->error());};				
					
if(count($datos['sedes'])>0){inserta_sedes($datos['sedes'], $idseek);};		
if(count($datos['contactos'])>0){inserta_contactos($datos['contactos'], $idseek);	};	
if((!$idfusion)&&(count($datos['campos'])>0)){inserta_campos($datos['campos'], $idseek);	};		
}		

return $fallo;	
}



$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT idofer from import_listcentros_a_importar where hecho=0 limit 1;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$idc=$row['idofer'];};		
if (!$dbnivel->close()){die($dbnivel->error());};




$datos=datos_centro($idc);
$datos['idc']=$idc;
utf8_encode_deep($datos);

$fallo=insterta_centro($datos);


if(!$fallo){
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "UPDATE import_listcentros_a_importar set hecho=1 where idofer=$idc;";
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
<body onload="JavaScript:timedRefresh(5000);">
<p>

Insertados centro: ' . $idc . '
</p>
</body>
</html>

';
}
?>