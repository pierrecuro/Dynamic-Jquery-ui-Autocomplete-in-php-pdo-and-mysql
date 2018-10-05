<?php
include "config.php";

$request = $_POST['request'];    

if($request == 1){
    $search = $_POST['search'];
    $gsent = $conectar->prepare("SELECT * FROM asociaciones where sector like '%$search%'");
    $gsent->execute(); 
    while($rows=$gsent->FETCH(PDO::FETCH_ASSOC)){
        $response[] = array("value"=>$rows['codigoAsociacion'],"label"=>$rows['sector']);
    }
    echo json_encode($response);
    exit;
}

if($request == 2){  
    $varcodigoAsociacion = $_POST['varcodigoAsociacion'];
    $gsent = $conectar->prepare("SELECT * FROM asociaciones where codigoAsociacion ='$varcodigoAsociacion'");
    $gsent->execute(); 
    $users_arr = array();   
    while($row=$gsent->FETCH(PDO::FETCH_ASSOC)){
            $varcodigoAsociacion = $row['codigoAsociacion']; 
            $nombreProyecto = $row['nombreProyecto']; 
            $codigoUnificado = $row['codigoUnificado'];
            $sector = $row['sector'];
            $cadenaProductiva = $row['cadenaProductiva'];
            $users_arr[] = array("codigoAsociacion" => $varcodigoAsociacion, "nombreProyecto" => $nombreProyecto, "codigoUnificado" => $codigoUnificado, "sector" => $sector, "cadenaProductiva" => $cadenaProductiva);
    } 
    echo json_encode($users_arr);
    exit;
}
  
?>