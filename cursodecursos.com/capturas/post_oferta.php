<?php //extract data from the post
#extract($_POST);

//set POST variables
$url = 'http://www.ofertaformativa.com/scripts/solicitud_de_informacion.php';
$fields = array(
            'cup_nombre'=>'Jacinto',
            'cup_apellidos'=>'Fernandez Amigo',
            'fecha[dia]'=>'15',
            'fecha[mes]'=>'02',
            'fecha[anio]'=>'1979',
            
            'cup_nacionalidad'=>'8',
            
			'cup_sexo'=>'1',	
			
            'cup_email'=>'jferamigo@hotmail.es',
            'cup_tel1'=>'658254565',
            'cup_poblacion'=>'Leganes',
            'cup_cp'=>'28045',
            'cup_pais'=>'8',
            'cup_provincia'=>'126',
            'cup_direccion'=>'calle Jardin',
            'cup_numero'=>'22',
            
			
            'cup_estudios'=>'12',
            
            'cup_comentarios'=>'',
            
            'cup_id_curso'=>'728917',
            'cup_id_centro'=>'1204',
            'cup_id_curso_propio'=>'117',
            'cup_nombre_curso'=>'Auxiliar de Odontología',
			            
			'noexcel'=>'0',
			'cup_libre1'=>'',
			'cup_libre2'=>'',
			'cup_libre3'=>'',
			'cup_libre4'=>'',
			'cup_id_portal'=>'1',

			'boletin'=>'si',
			'destacadocat'=>'0',
			'cesiondatos'=>'1',
			'Submit'=>'Submit',

			'cup_id_opcioncurso'=>''
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
echo rtrim($fields_string,'&');

//open connection
#$ch = curl_init();

//set the url, number of POST vars, POST data
#curl_setopt($ch,CURLOPT_URL,$url);
#curl_setopt($ch,CURLOPT_POST,count($fields));
#curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

//execute post
#$result = curl_exec($ch);

//close connection
#curl_close($ch);

?>

