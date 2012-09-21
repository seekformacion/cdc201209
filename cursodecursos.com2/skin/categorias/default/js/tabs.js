function navi_menu_in(tab){
var tab;
var tot;
tot= tab + 'tot';
document.getElementById(tab).style.visibility = 'visible';
document.getElementById(tot).style.zIndex = 10;
}	

function navi_menu_out(tab){
var tab;
var tot;
tot= tab + 'tot';
document.getElementById(tab).style.visibility = 'hidden';
document.getElementById(tot).style.zIndex = 0;
}
	
function addCompare (codcurso,idcat){
var codcurso;
var idcat;
navi_menu_in('tab1');
var t=setTimeout('navi_menu_out("tab1")', 3000);	
ChangeListCompare(codcurso,idcat);
}

function quitCompare (codcurso){
	var codcurso;
	ChangeListCompare(codcurso);
	document.getElementById('compara-'+codcurso).checked = false;
}


	
	
var conexion1;
function ChangeListCompare(codcurso,idcat){
var codcurso;
var idcat;

conexion1=crearXMLHttpRequest();
conexion1.onreadystatechange = procesarEventos;
conexion1.open('GET', '/scripts/listCompare.php?idcat=' + idcat + '&codCompare='+codcurso , true);
conexion1.send(null);  
}

function procesarEventos(){
var detalles = document.getElementById("ListCompare");
var detallesOLD = detalles.innerHTML;
 
  if(conexion1.readyState < 4)
  {
	  detalles.innerHTML = '<div class="loadding"></div>' + detallesOLD ;
  } 
  else 
  {
	  detalles.innerHTML = conexion1.responseText;
   }
}











//***************************************
//Funciones comunes a todos los problemas
//***************************************

function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}
	



	
