<?php 

$numcur=COUNTCursCAT($idcat);
$numpag=ceil($numcur /10);



$a=1;
while($a <= $numpag){
$rdatos_pag[pags][$a][numero]=$a;
$rdatos_pag[pags][$a][url]=str_replace('.html','-pag'. $a . '.html',$vars[url]);$a++;
}
$rdatos=array();
$d_layout[CatPagination]=splitsheet(read_layout(GetPath('layout/CatLandingPagination.html',$design)),"CatPagination",$rdatos, $rdatos_pag);

?>