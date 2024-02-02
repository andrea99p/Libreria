<?php 
$host="localhost";
$username="root";
$password="root";
$dbname="libreria";
$conn = new mysqli($host,$username,$password,$dbname);

$data = json_decode(file_get_contents('php://input'), true);
$user_id = isset($data['user_id']) ? $data['user_id'] : '';

if($conn->connect_errno){
    die("connessione fallita". $conn->connect_errno);
}

$stmt= $conn->prepare("SELECT titolo, autore, id FROM libro where user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$titoloLibri= array();

while($row = $result->fetch_assoc()){
    $titoloLibri[] = $row;
}

header('Content-Type: application/json');
echo json_encode($titoloLibri);


?>