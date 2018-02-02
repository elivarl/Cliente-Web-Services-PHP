<?php

    header('Content-Type: text/html; charset=ISO-8859-1'); 
    require_once('lib/nusoap.php');

    //Parámetros
    $slengua = "C";
    $scurso = "2011-12";
    $scoddep = "B142";
    $scodest = "";
    
    //url del webservice
    $wsdl="https://cvnet.cpd.ua.es/servicioweb/publicos/pub_gestdocente.asmx?wsdl";
    
    //instanciando un nuevo objeto cliente para consumir el webservice
    $client=new nusoap_client($wsdl,'wsdl');

    //pasando los parámetros a un array
    $param=array('plengua'=>$slengua, 'pcurso' => $scurso, 'pcoddep' => $scoddep, 'pcodest' => $scodest);

    //llamando al método y pasándole el array con los parámetros
    $resultado = $client->call('wsasidepto', $param);
   
    //si ocurre algún error al consumir el Web Service
    if ($client->fault) { // si
        $error = $client->getError();
    if ($error) { // Hubo algun error
            //echo 'Error:' . $error;
            //echo 'Error2:' . $error->faultactor;
            //echo 'Error3:' . $error->faultdetail;faultstring
            echo 'Error:  ' . $client->faultstring;
        }
        
        die();
    }
    
    echo "<pre>";
    //print_r($resultado);
	$result=$resultado['wsasideptoResult']['ClaseAsiDepto'];
	
	for($i=0;$i<=count($result);$i++){
		echo $result[$i]['codasi']."<br>";
		echo $result[$i]['nomasi']."<br>";
		echo $result[$i]['enlaceasi']."<br>";
		echo $result[$i]['codest']."<br>";
		echo $result[$i]['nomest']."<br>";
		echo "<br>"."<br>";		
	}	
    echo "</pre>";
 
 
?>