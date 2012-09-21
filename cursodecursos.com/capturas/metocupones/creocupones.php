<?php 

$paths[root]="/home/laiislac/seekvero";
$paths[www]="/home/laiislac/www/cursodecursos.com";


$paths[dtb]=$paths[root] . "/core/db";
################################## DB connect
$conf[host]="localhost";
$conf[db]="laiislac_boletines";
$conf[usr]="laiislac";
$conf[pass]="ideosites2009";

$paths[dtb]=$paths[root] . "/core/db";


include $paths[dtb] . '/db.php';

echo $paths[dtb];

$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

$queryp= "SELECT * FROM boletines limit 10000, 100;";

$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){

$datos[$row[id_boletin]][nombre]=ucwords(strtolower($row[bol_nombre]));
$apellidos=array();
$apellidos=split(' ',ucwords(strtolower($row[bol_apellidos])));
$datos[$row[id_boletin]][ap1]=$apellidos[0];
$datos[$row[id_boletin]][ap2]=$apellidos[1];
$datos[$row[id_boletin]][sexo]=$row[bol_sexo]; #1 mujer
}
if (!$dbnivel->close()){die($dbnivel->error());};








$datosCentro[]=array( id=>1204,  idc=>728917,  idp=>117,  tit=>'Auxiliar de Odontologia');
$datosCentro[]=array( id=>1204,  idc=>123,  idp=>2344,  tit=>'dededed');

print_r($datosCentro);

?>