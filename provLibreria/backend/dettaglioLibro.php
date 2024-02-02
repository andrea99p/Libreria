<?php 



$host="localhost";
$username="root";
$password="root";
$dbname="libreria";
$conn = new mysqli($host,$username,$password,$dbname);

$libro_id = $_GET['id'];

$stmt = $conn->prepare("SELECT titolo,autore,trama,codiceisbn,numeroletture FROM libro WHERE id=?");
$stmt->bind_param("i", $libro_id );

$stmt->execute();

$result = $stmt->get_result();
$libro = $result->fetch_assoc();

$conn->close();

header('Content-Type: application/json');
echo json_encode($libro);

?>