<?php

$idc=939;


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




print_r($datos);
print_r($lineas);

?>