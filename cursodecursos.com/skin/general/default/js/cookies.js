
$(document).ready(function() {

	var surl =  "http://www.seekformacion.com/remotes/session.php?callback=?"; 
	var me = $(this); 
	$.getJSON(surl,  function(rtndata) { 
		alert(rtndata.message);

 });
 
}); 


