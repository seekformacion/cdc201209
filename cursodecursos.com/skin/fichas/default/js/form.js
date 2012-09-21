function form_up(){
	
	var capa='form';
	var capa1=capa + '_fondo';
	var capa2=capa + '_up';

	var muestra=document.getElementById(capa1);
	var muestra2=document.getElementById(capa2);


	if (muestra.style.visibility == 'visible'){
	muestra.style.visibility = 'hidden';
	muestra2.style.visibility = 'hidden';
	}else{
	muestra.style.visibility = 'visible';
	muestra2.style.visibility = 'visible';	
	}

	
}