<?php 


$contador=0;
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT Texto FROM skv_TextosLandigCat where id_LandingCat='$idcat';";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
	$rdatos[Texto]='<p>' . str_replace("\n","<br>",$row[Texto]) . '</p>';
	$rdatos_ad_txtcat[Texto]=$row[Texto];
}
if (!$dbnivel->close()){die($dbnivel->error());};


$rdatos[idcat]=$idcat;
$rdatos[titCat]=$DatosLandingCat[titCat];

$d_layout[textosCat]=splitsheet(read_layout(GetPath('layout/textosCat.html',$design)),"textosCat",$rdatos, $rdatos);




?>