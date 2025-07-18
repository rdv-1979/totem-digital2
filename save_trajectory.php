<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root"; // Cambia esto si tu usuario es diferente
$password = ""; // Cambia esto si tienes una contraseña
$dbname = "localizacion";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del POST
$data = json_decode(file_get_contents('php://input'), true);
$inicio = $data['inicio'];
$destino = $data['destino'];
$distancia_km = $data['distancia_km'];
$duracion_min = $data['duracion_min'];

// Insertar datos en la base de datos
$sql = "INSERT INTO trayectorias (inicio, destino, distancia_km, duracion_min) VALUES ('$inicio', '$destino', $distancia_km, $duracion_min)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
