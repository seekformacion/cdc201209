
function slide(bloque){
		var bloque;
		if(document.getElementById('1')!=null){document.getElementById('1').className = "bloque_nav out";};
		if(document.getElementById('2')!=null){document.getElementById('2').className = "bloque_nav out";};
		if(document.getElementById('3')!=null){document.getElementById('3').className = "bloque_nav out";};
		
		if(document.getElementById('1a')!=null){document.getElementById('1a').className = "Navdentro Nv_";};
		if(document.getElementById('2a')!=null){document.getElementById('2a').className = "Navdentro Nv_";};
		if(document.getElementById('3a')!=null){document.getElementById('3a').className = "Navdentro Nv_";};
		
		if(document.getElementById('1b')!=null){document.getElementById('1b').className = "carpSuperNav cpS_";};
		if(document.getElementById('2b')!=null){document.getElementById('2b').className = "carpSuperNav cpS_";};
		if(document.getElementById('3b')!=null){document.getElementById('3b').className = "carpSuperNav cpS_";};

		if(document.getElementById('1c')!=null){document.getElementById('1c').className = "carpInfeNaV cpI_";};
		if(document.getElementById('2c')!=null){document.getElementById('2c').className = "carpInfeNaV cpI_";};
		if(document.getElementById('3c')!=null){document.getElementById('3c').className = "carpInfeNaV cpI_";};

		
		document.getElementById(bloque).className = "bloque_nav over CBc";
		document.getElementById(bloque+ 'a').className = "Navdentro Nv_over";
		document.getElementById(bloque+ 'b').className = "carpSuperNav cpS_over";
		document.getElementById(bloque+ 'c').className = "carpInfeNaV cpI_over";
	}
	
	
	