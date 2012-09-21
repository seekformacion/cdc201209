<?php
################ recuperacion de variables GET #####################
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
####################################################################
	
	
include '../variables.php';


$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};








$queryp= "SELECT *  FROM skv_equiarbol where idofer=$sup;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$supseek=$row[idseek];};

$actseek=0;
$queryp= "SELECT *  FROM skv_equiarbol where idofer=$act;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){$actseek=$row[idseek];};



	
	
	


if($accion=="crear"){

$queryp="INSERT INTO skv_urls (site,visible,titCat,url,tipo,design) values (1,1,'$nombre','$url',1,'')";
$dbnivel->query($queryp);

echo "$queryp <br>";

$queryp= "SELECT LAST_INSERT_ID() as id FROM skv_urls;";
$dbnivel->query($queryp);
echo "$queryp <br>";

while ($row = $dbnivel->fetchassoc()){$id=$row[id];};	

$queryp="INSERT INTO skv_TextosLandigCat (id_LandingCat) values ($id)";	
$dbnivel->query($queryp);
echo "$queryp <br>";

$queryp="INSERT INTO skv_subcats (idcat,idSubCat) values ($supseek,$id)";
$dbnivel->query($queryp);
echo "$queryp <br>";


$queryp="INSERT INTO skv_equiarbol (idseek,idofer) values ($id,$act)";
$dbnivel->query($queryp);
echo "$queryp <br>";

$a=1;
while ($a <= 5){$a++;
$queryp="INSERT INTO skv_CursosVirtuales (id_landingCat) values ($id)";
$dbnivel->query($queryp);
echo "$queryp <br>";	
}



	
}	
	
	
	
	
	
	
	
	

	
$boton="crear";	
$accionCampo=' onclick="javascript:rellena();" ';

if($actseek){
$boton="modificar";	$accionCampo="";
$queryp= "SELECT *  FROM skv_urls where id=$actseek;";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
	$nombre=$row[titCat];
	$url=$row[url];
}
	
}	
	
	if (!$dbnivel->close()){die($dbnivel->error());};	
?>




<script>
	function rellena(){
		var nombre;
		var url;
		nombre=document.getElementById('nombre').value;
		nombre=nombre.replace(/ /g,"_");
		nombre=nombre.toLowerCase();
		
		nombre=nombre.replace(/á/g,"a");
		nombre=nombre.replace(/é/g,"e");
		nombre=nombre.replace(/í/g,"i");
		nombre=nombre.replace(/ó/g,"o");
		nombre=nombre.replace(/ú/g,"u");
		nombre=nombre.replace(/ü/g,"u");
		nombre=nombre.replace(/ñ/g,"n");
		
		
		url="/" + nombre + ".html"
		document.getElementById('url').value=url;
	}
</script>



Cat sup Oferta: <input type="text" size="2" name="supofe" value="<?php echo $sup;?>"> --> Cat sup Seek: <input type="text" size="2" name="supseek" value="<?php echo $supseek;?>">
<br><br>

<form action="poparbol.php" method="get">
<input type="hidden" name="sup" value="<?php echo $sup;?>">
<input type="hidden" name="act" value="<?php echo $act;?>">

Nombre <br>	
<input type="text" size="40" name="nombre" value="<?php echo $nombre;?>" id="nombre">
<br>
Url <br>
<input type="text" size="40" name="url" value="<?php echo $url;?>" <?php echo $accionCampo;?> id="url">
	
	
<br>
<br>
<input type="submit" name="accion" value="<?php echo $boton;?>">	
</form>



