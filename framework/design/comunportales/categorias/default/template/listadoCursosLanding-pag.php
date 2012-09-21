<?php 
#######################
### genera el listado de cursos
###########################

$cursos=GetCursCAT($idcat);


$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};

foreach ($cursos as $pointer => $idcurcat){
$queryp= "SELECT * FROM skv_cursos where id='$idcurcat';";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
$contador++;

	$listado[$idcurcat][titulo]=$row[nombre];
	$listado[$idcurcat][descripcion]=$row[cur_descripcion];
	$listado[$idcurcat][logo]=$row[id_centro];

}}


if (!$dbnivel->close()){die($dbnivel->error());};








foreach ($listado as $codcurso => $Dat_cursos){

$Dat_cursos[idcat]=$design;
$Dat_cursos[urlIMG_masinfo]=GetSKINPath ('botones/liscat_masinfo.png',$design);
$Dat_cursos[urlIMG_comparar]=GetSKINPath ('botones/liscat_comparar.png',$design);
$Dat_cursos[titCat]=$DatosLandingCat[titCat];
$Dat_cursos[codcurso]=$codcurso;

$caja=splitsheet(read_layout(GetPath('layout/cajaCursoLanding.html',$design)),"cajacurso",$Dat_cursos,'');

$d_layout[listadoCursos] .=$caja;
}

?>



