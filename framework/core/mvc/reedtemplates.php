<?php
function cachea($cadenahtm){
	
	$datos=$_SERVER["REQUEST_URI"];

	
	
	$datos=str_replace(".htm","",$datos);
	

	
	
	$camino="/home/laiislac/public_html/seekformacion.com/".$primero;
	
	if(!is_dir($camino)){#chekeo si existe ya ese directorio
		#mkdir($camino);
	}


	$datos=trim($datos,'/');


	$niveles=split("/",$datos);
	$numelem=count($niveles);
	foreach ($niveles as $key=>$value){
		if($key<($numelem-1)){
			$camino=$camino."/".$value;
			if(!is_dir($camino)){
				mkdir($camino);
			}
		}else{
			$ficherohtml=$value;
		}
	}

	
	
	if(!$ficherohtml){$ficherohtml="index";};

	if(!file_exists($camino."/".$ficherohtml.".htm")){
		$archivo=fopen($camino."/".$ficherohtml.".htm",w);
		fwrite($archivo,$cadenahtm);
		fclose($archivo);
	}
}



#################################### comprobamos diseño especifico
function arlayout ($tipo,$id){
global $paths;
global $vars;
$donde=$paths[ly] . '/' . $vars[site] . '/' . $tipo . '/' . $id . '.html';
$dondeGeneral=$paths[ly] . '/' . $vars[site] . '/' . $tipo . '/0.html';

if (file_exists($donde)) {return read_layout($donde);}
 					else {return read_layout($dondeGeneral);};

}
#########################################################################




#################################### comprobamos template especifico
function ainclude_templates ($tipo,$id){
global $paths;
global $vars;
$donde=$paths[tmp] . '/' . $vars[site] . '/' . $tipo .  $id . '.php';
$dondeGeneral=$paths[tmp] . '/' . $vars[site] . '/' . $tipo . 'general.php';

if (file_exists($donde)) {return $donde;}
 					else {return $dondeGeneral;};

}
#########################################################################


#################################### comprobamos diseño objetos html especifico
function arobjetos ($tipo,$id){
global $paths;
global $vars;
$donde=$paths[obj] . '/' . $vars[site] . '/' . $tipo . '/' . $id . '.html';
$dondeGeneral=$paths[obj] . '/' . $vars[site] . '/' . $tipo . '/general.html';


if (file_exists($donde)) {return read_layout($donde);}
 					else {return read_layout($dondeGeneral);};

}
#########################################################################


function GetPath($objeto,$id){
global $paths;
global $vars;
global $where;


$donde[]=$paths[root] . '/design/comunportales/general/default/' . $objeto;
$donde[]=$paths[root] . '/design/comunportales/general/' . $id . '/' . $objeto;
$donde[]=$paths[root] . '/design/comunportales/' . $where[tipo] . '/default/' . $objeto;
$donde[]=$paths[root] . '/design/comunportales/' . $where[tipo] . '/' . $id . '/' . $objeto;

$donde[]=$paths[root] . '/design/' . $vars[site] . '/general/default/' . $objeto;
$donde[]=$paths[root] . '/design/' . $vars[site] . '/general/' . $id . '/' . $objeto;
$donde[]=$paths[root] . '/design/' . $vars[site] . '/' . $where[tipo] . '/default/' . $objeto;
$donde[]=$paths[root] . '/design/' . $vars[site] . '/' . $where[tipo] . '/' . $id . '/' . $objeto;


foreach( $donde as $point => $rut){
if (file_exists($rut)) {$donde=$rut;}	
}


return $donde;


}


function GetSKINPath ($objeto,$id){
	
global $paths;
global $vars;
global $where;


$donde1=$paths[www] . '/skin/general/default/' . $objeto;
$donde2=$paths[www] . '/skin/general/' . $id . '/' . $objeto;
$donde3=$paths[www] . '/skin/categorias/default/' . $objeto;
$donde4=$paths[www] . '/skin/categorias/' . $id . '/' . $objeto;
$donde5=$paths[www] . '/skin/' . $where[tipo] . '/default/' . $objeto;
$donde6=$paths[www] . '/skin/' . $where[tipo] . '/' . $id . '/' . $objeto;

if(file_exists($donde1)){$ruta=$donde1;};
if(file_exists($donde2)){$ruta=$donde2;};
if(file_exists($donde3)){$ruta=$donde3;};
if(file_exists($donde4)){$ruta=$donde4;};
if(file_exists($donde5)){$ruta=$donde5;};
if(file_exists($donde6)){$ruta=$donde6;};

return str_replace($paths[www],'',$ruta);
					
					
					
}




################## funcion apertura de archivos ##########
function read_layout($donde){
$fp = fopen($donde, "r");
if($fp){while(!feof($fp)){$lineas[]= fgets($fp);};	fclose($fp);};	
return $lineas;	
}
##########################################################


function splitsheet($file,$obj,$valores,$recursividad){
$queprincipio="<!-- $obj -->";
$quefin="<!-- fin $obj -->";

$valores[enlacescaut]="";#enlacescaut();


foreach($file as $line){
$line=str_replace("\n","",$line);
$line=str_replace("\r","",$line);
$line=trim($line);


if($line == $quefin){$agrupo=0;};
if ($agrupo){

			
		
			if($valores){
			foreach($valores as $key => $valor){
			$key="%" .$key . "%";
			$line=str_replace($key,$valor,$line);	
			}}		
				
			$lineas2[]=$line ;


}
if($line == $queprincipio){$agrupo=1;};

}


if($recursividad){
$html=recursividad($lineas2,$recursividad);	
}else{

if(count($lineas2)>0){	
foreach($lineas2 as $line){
	
	$pattern="<!--(.*)-->";
	$html=preg_replace($pattern,"", $html);
	$html .=$line . "\n";
	
}	}
}

$pattern="<!-- -->";
$html=str_replace($pattern,"", $html);	
return $html;
}


function recursividad($lineas2,$recursividad){
	

if($recursividad){
	foreach ($recursividad as $que2 => $datos){
		
			$queprincipio2="<!-- $que2 -->";
			$quefin2="<!-- fin $que2 -->";
			
	
			
			$lineas3="";
			foreach($lineas2 as $line){
			$line=str_replace("\n","",$line);
			$line=str_replace("\r","",$line);
			$line=trim($line);
			
			if($line == $queprincipio2){$agrupo2=1;};
			
			
			
			
			if (!$agrupo2){
			  	
			  	
			  	if(($line == $queprincipio2)||($line == $quefin2)){}else{$lineas3[]=$line;};
			  	
			  	
			  	
			}else{
				
					if(($line == $queprincipio2)||($line == $quefin2)){}else{$minicodigo[$que2][]=$line . "\n\r";};
		  }	
			
			if($line == $quefin2){$agrupo2=0;$lineas3[]="%$que2%";};
			
		
			
			}
			$lineas2=$lineas3;
			
		
		
	}
	}
#echo "--------------- \n";
#print_r($lineas3);
#print_r($minicodigo);

foreach ($recursividad as $que2 => $valores){
$codigo2="";
$codigo="";


if(count($minicodigo) > 0){foreach ($minicodigo[$que2] as $lineac){$codigo .=$lineac;};};


echo "\n----------" . print_r($valores);

if(count($valores) > 0){
foreach($valores as $notdo => $cual){
	
$codigo2 .=$codigo;
foreach($cual as $key => $valor){
$key="%" .$key . "%";
$codigo2=str_replace($key,$valor,$codigo2);	
}

}}

$codigotot[$que2]=$codigo2;	
	
}



#print_r($codigotot);
	
foreach($lineas3 as $linehtml){
	
	$html .=$linehtml;
	

	}
	
foreach($codigotot as $que => $remplazo){

$busco="%$que%";

if($recursividad[$que][0]){$remplazo="";};

$html=str_replace($busco,$remplazo,$html);		
		
		
	}




return $html;
	
}


function enlacescaut(){

$arrayprovis[]='A Coru�a';
$arrayprovis[]='Alicante';
$arrayprovis[]='Almer�a';
$arrayprovis[]='Asturias';
$arrayprovis[]='Baleares';
$arrayprovis[]='Barcelona';
$arrayprovis[]='C�diz';
$arrayprovis[]='Cantabria';
$arrayprovis[]='Castell�n';
$arrayprovis[]='C�rdoba';
$arrayprovis[]='Girona';
$arrayprovis[]='Granada';
$arrayprovis[]='Guadalajara';
$arrayprovis[]='Guip�zcoa';
$arrayprovis[]='Huelva';
$arrayprovis[]='Madrid';
$arrayprovis[]='M�laga';
$arrayprovis[]='Navarra';
$arrayprovis[]='Pontevedra';
$arrayprovis[]='Santa Cruz de Tenerife';
$arrayprovis[]='Sevilla';
$arrayprovis[]='Toledo';
$arrayprovis[]='Valencia';
$arrayprovis[]='Vizcaya';
$arrayprovis[]='Zaragoza';
	
shuffle($arrayprovis);

$provincia=$arrayprovis[1];
$proviparaenlace=str_replace(" ","_",$provincia);
$enlace="_en_la_provincia_de_$proviparaenlace.htm";

$remplazo="
<a href='http://www.fontanero-barato.com/Fontaneros" . $enlace . "' class='blanquito'>[ Fontaneros en $provincia ]</a>
<a href='http://www.cerrajero-barato.com/Cerrajeros" . $enlace . "' class='blanquito'>[ Cerrajeros en $provincia ]</a>
<a href='http://www.electricista-barato.com/Electricistas" . $enlace . "' class='blanquito'>[ Electricistas en $provincia ]</a>
<a href='http://www.pocero-barato.com/Poceros" . $enlace . "' class='blanquito'>[ Poceros en $provincia ]</a>
";

return $remplazo;
	
}

?>