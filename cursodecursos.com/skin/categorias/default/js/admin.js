
	
	
var conexion_save_field;
function SaveField(field,idcat){
var field;
var idcat;
var value;

var value = document.getElementById(field).value;


conexion_save_field=crearXMLHttpRequest();
/* conexion_save_field.onreadystatechange = procesarEventos; */
conexion_save_field.open('GET', '/scripts/admin/savefield.php?field=' + field + '&value=' + value + '&idcat='+idcat , true);
conexion_save_field.send(null);  

alert(field + ' guardada');
}



function bot_edit_textcat(){
	document.getElementById('edit_textcat').style.visibility='visible';
	document.getElementById('bot_guardar_textcat').style.visibility='visible';
	document.getElementById('TXT_cat').style.visibility='hidden';
	document.getElementById('imgTextCat').style.visibility='hidden';
	document.getElementById('bot_edit_textcat').style.visibility='hidden';
	
}


function editcurvir(codcur){
	var codcur;
	document.getElementById('tit_cvirtual-'+codcur).style.visibility='visible';
	document.getElementById('desc_cvirtual-'+codcur).style.visibility='visible';
	document.getElementById('botsave-'+codcur).style.visibility='visible';
	document.getElementById('botedit-'+codcur).style.visibility='hidden';
}



function bot_guardar_textcat(idcat){
	var idcat;
	var value;
	var value = document.getElementById('Text_Cat_area').value;
	value = value.replace(/\n\r?/g, '%L%');
	
	conexion_save_field=crearXMLHttpRequest();
	conexion_save_field.onreadystatechange = procesarTextCat;
	conexion_save_field.open('GET', '/scripts/admin/savetextcat.php?value=' + value + '&idcat='+idcat , true);
	conexion_save_field.send(null); 
	
	
}


function savecurvir(codcur){
	var codcur;
	var tit;
	var desc;
	var tit = document.getElementById('tit_cvirtual-' + codcur).value;
	var desc = document.getElementById('desc_cvirtual-' + codcur).value;
	
		
	conexion_save_field=crearXMLHttpRequest();
	conexion_save_field.onreadystatechange = procesarCurVir;
	conexion_save_field.open('GET', '/scripts/admin/savecurvir.php?idvir=' + codcur + '&tit=' + tit + '&desc='+ desc , true);
	conexion_save_field.send(null); 	
	
	
}


function procesarCurVir(){
	
	
		
	
	 if(conexion_save_field.readyState < 4) 
	  {}else{
		  	var cadena=conexion_save_field.responseText;
			var mytool_array=cadena.split("||");
			 	
			var codcur=mytool_array[2];
			
			
			var codigoTit = document.getElementById("tit-" + codcur);
			var codigoDesc = document.getElementById("desc-" + codcur);
			
			codigoTit.innerHTML = mytool_array[0];
			codigoDesc.innerHTML = mytool_array[1];
		  
		  	document.getElementById('tit_cvirtual-' + codcur).style.visibility='hidden';
			document.getElementById('desc_cvirtual-' + codcur).style.visibility='hidden';
			document.getElementById('botsave-' + codcur).style.visibility='hidden';
			document.getElementById('botedit-' + codcur).style.visibility='visible'; 
			
	   }
	
	
	
	
}



function procesarTextCat(){
	var detalles = document.getElementById("TXT_cat");
	var detallesOLD = detalles.innerHTML;
	 
	  if(conexion_save_field.readyState < 4) 
	  {}else{
		  detalles.innerHTML = conexion_save_field.responseText;
		  	document.getElementById('edit_textcat').style.visibility='hidden';
			document.getElementById('bot_guardar_textcat').style.visibility='hidden';
			document.getElementById('TXT_cat').style.visibility='visible';
			document.getElementById('imgTextCat').style.visibility='visible';
			document.getElementById('bot_edit_textcat').style.visibility='visible';
			
	   }
	}


