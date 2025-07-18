<?php
header('Content-Type: application/json');

$servername = "sql103.infinityfree.com";
$username = "if0_39169364"; // Cambia esto si tu usuario es diferente
$password = "zxp9vhkjTTq"; // Cambia esto si tienes una contraseña
$dbname = "if0_39169364_localizacion";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consultar datos de la base de datos
$sql = "SELECT id, inicio, destino, distancia_km, duracion_min FROM trayectorias";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo json_encode(["status" => "error", "message" => "No se encontraron datos"]);
    $conn->close();
    exit;
}

$conn->close();

echo json_encode($data);
?>
