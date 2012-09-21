<?php 
#######################
### genera el listado de cursos
###########################


$contador=0;
$dbnivel=new DB($conf[host],$conf[usr],$conf[pass],$conf[db]);
if (!$dbnivel->open()){die($dbnivel->error());};
$queryp= "SELECT * FROM skv_CursosVirtuales where id_landingCat='$idcat';";
$dbnivel->query($queryp);
while ($row = $dbnivel->fetchassoc()){
$contador++;

	$listado[$row[id]][titulo]=$row[Titulo];
	$listado[$row[id]][descripcion]=$row[Descripcion];

}
if (!$dbnivel->close()){die($dbnivel->error());};








foreach ($listado as $codcurso => $Dat_cursos){

$Dat_cursos[idcat]=$design;
#$Dat_cursos[urlIMG_masinfo]=GetSKINPath ('botones/liscat_masinfo.png',$design);
#$Dat_cursos[urlIMG_comparar]=GetSKINPath ('botones/liscat_comparar.png',$design);
$Dat_cursos[titCat]=$DatosLandingCat[titCat];
$Dat_cursos[codcurso]=$codcurso;
$Dat_cursos[logo]=$codcurso+120;


if($vars[MODadmin]){
	$Dat_cursos[admin]=splitsheet(read_layout(GetPath('layout/cajaCursoLanding.html',$design)),"cajacurso_admin",$Dat_cursos,'');
}else{
	$Dat_cursos[admin]="";
}


$caja=splitsheet(read_layout(GetPath('layout/cajaCursoLanding.html',$design)),"cajacurso",$Dat_cursos,'');

$d_layout[listadoCursos] .=$caja;

}

?>



