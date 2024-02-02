<?php 

$host="localhost";
$username="root";
$password="root";
$dbname="libreria";
$conn = new mysqli($host,$username,$password,$dbname);

$data = json_decode(file_get_contents('php://input'),true);
$user_id = isset($data["user_id"]) ? $data["user_id"] : "";
$libro_id = isset($data["libro_id"]) ? $data["libro_id"] : "";

$stmt = $conn->prepare("UPDATE libro SET numeroletture = numeroletture+1 WHERE user_id=? and id=?");
$stmt->bind_param("ii", $user_id, $libro_id);
$stmt->execute();


if($stmt->affected_rows>0){
    $response["success"] = true;
    $response["message"]="il numero della lettura è stato incrementato";
}
else{
    $response["success"] = false;
    $response["false"] = "qualcosa è andato storto, il numero delle letture non è stato incrementato";
}

header('Content-Type: application/json');
echo json_encode($response);
?>