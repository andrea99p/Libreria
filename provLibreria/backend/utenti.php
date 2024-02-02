<?php 
$host="localhost";
$username="root";
$password="root";
$dbname="libreria";
$conn = new mysqli($host,$username,$password,$dbname);

if($conn->connect_error){
    die("connesione fallita". $conn->connect_error);
  }

$result = $conn->query('SELECT * FROM user');
$utenti = array();

while($row = $result->fetch_assoc()){
    $utenti[] = $row;
}

header('Content-Type: application/json');
echo json_encode($utenti);

?>