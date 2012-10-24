<html>
<head>
   <title>Prueba de cookies remotas</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
<script> 
$(document).ready(function() {

	var surl =  "http://www.seekformacion.com/remotes/session.php?callback=?"; 
	var me = $(this); 
	$.getJSON(surl,  function(rtndata) { 
		alert(rtndata.message);

 });
 
}); 
</script>


</head>
<body>




</body>
</html> 
	