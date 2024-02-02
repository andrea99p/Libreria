<?php 
$data = json_decode(file_get_contents('php://input'), true);
$titolo = isset($data['titolo']) ? $data['titolo'] : '';
$autore = isset($data['autore']) ? $data['autore'] : '';
$codiceIsbn = isset($data['codiceisbn']) ? $data['codiceisbn'] : '';
$trama = isset($data['trama']) ? $data['trama'] : '';
$email = isset($data['email']) ? $data['email'] : '';
$user_id = isset($data['user_id']) ? $data['user_id'] : '';

$host="localhost";
$username="root";
$password="root";
$dbname="libreria";
$conn = new mysqli($host,$username,$password,$dbname);

if($conn->connect_error){
    die("connesione fallita". $conn->connect_error);
  }

$stmt = $conn->prepare('INSERT INTO libro(titolo,autore,codiceisbn,trama,email,user_id,dataaggiunta) VALUES (?,?,?,?,?,?,CURDATE())');
$stmt->bind_param("sssssi",$titolo, $autore, $codiceIsbn, $trama, $email,$user_id);

if($stmt->execute() === false){
    die($stmt->error);
}
?>