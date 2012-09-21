<?php 


$d_layoutC[urlLogo]=GetSKINPath('logo.png',$where[design]);
$d_layout[cabeceralogo]= splitsheet(read_layout(GetPath('layout/cabeceralogo.html',$where[design])),"cabeceralogo",$d_layoutC,"");

?>