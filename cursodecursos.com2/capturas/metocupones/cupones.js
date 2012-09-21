	
var conexion1;

function metocupon(){


	conexion1=crearXMLHttpRequest();
	conexion1.onreadystatechange = procesarEventos;
	conexion1.open('GET', 'datos.php' , true);
	conexion1.send(null);  
	
	

}



function metocupon2(parametros){

var parametros;
conexion1=crearXMLHttpRequest();
conexion1.onreadystatechange = procesarEventos;
conexion1.open('GET', 'http://www.ofertaformativa.com/scripts/solicitud_de_informacion.php?' + parametros , true);
conexion1.send(null);  
}






function procesarEventos(){
  if(conexion1.readyState < 4)
  {}else{	
	  metocupon2(conexion1.responseText);
   }}


function procesarEventos2(){

	 
	  if(conexion1.readyState < 4)
	  {  }else{		
		  alert(conexion1.responseText);
	   }}





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
	



	
