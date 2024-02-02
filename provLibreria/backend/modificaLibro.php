<?php
$host="localhost";
$username="root";
$password="root";
$dbname="libreria";
$conn = new mysqli($host,$username,$password,$dbname);
    $data = json_decode(file_get_contents("php://input"),true);

    $libro_id= isset($data["libro_id"]) ? $data["libro_id"] : "";
    $email= isset($data["email"]) ? $data["email"] : "";

    $conn = new mysqli($host,$username,$password,$dbname);

    if($conn->connect_errno){
        die("connesione fallita". $conn->connect_errno);
    }

    $query = "UPDATE libro SET ";
    $params = array();
    $types = "";

    if (isset($data["titolo"])) {
        $query .= "titolo=?, ";
        $types .= "s";
        $params[] = $data["titolo"];
    }

    if (isset($data["autore"])) {
        $query .= "autore=?, ";
        $types .= "s";
        $params[] = $data["autore"];
    }

    if (isset($data["codiceisbn"])) {
        $query .= "codiceisbn=?, ";
        $types .= "s";
        $params[] = $data["codiceisbn"];
    }

    if (isset($data["trama"])) {
        $query .= "trama=?, ";
        $types .= "s";
        $params[] = $data["trama"];
    }

    if (isset($data["letture"])) {
        $query .= "letture=?, ";
        $types .= "i";
        $params[] = $data["letture"];
    }

    
    $query = rtrim($query, ", ") . " WHERE id=? AND email=?";
    $types .= "is";
    $params[] = $libro_id;
    $params[] = $email;

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    $response=array();
    if($stmt-> affected_rows>0 ){
        $response["success"] = true;
        $response["messagge"] = "il libro è stato modificato";
    }
    else{
        $response["success"] = false;
        $response["messagge"] = "nessun libro trovato";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>