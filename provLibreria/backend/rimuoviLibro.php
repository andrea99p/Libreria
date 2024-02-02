<?php 
$data = json_decode(file_get_contents('php://input'),true);
$user_id = isset($data['user_id']) ? $data['user_id'] : "";
$libro_id = isset($data['libro_id']) ? $data['libro_id'] : "";

$conn = new mysqli("localhost","root","root","libreria");

if($conn->connect_errno){
    die("connesione fallita". $conn->connect_errno);
}

$stmt = $conn->prepare('DELETE FROM libro where user_id=? and id=?');
$stmt ->bind_param('ii', $user_id, $libro_id);
$stmt->execute();
$response = array();
if ($stmt->affected_rows > 0) {
    $response["success"] = true;
    $response["message"] = "Libro eliminato con successo.";
} else {
    $response["success"] = false;
    $response["message"] = "Nessun libro trovato con l'ID specificato.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
