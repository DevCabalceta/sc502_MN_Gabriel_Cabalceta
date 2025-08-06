<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// BD
$conn = new mysqli("localhost", "root", "Gc123456", "wishlist_db");

if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Conexión fallida"]);
  exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $result = $conn->query("SELECT * FROM wishes ORDER BY fecha DESC");
  $wishes = [];
  while ($row = $result->fetch_assoc()) {
    $wishes[] = $row;
  }
  echo json_encode($wishes);
  exit;
}

// Agregar 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  if (!isset($data['descripcion']) || empty(trim($data['descripcion']))) {
    http_response_code(400);
    echo json_encode(["error" => "Descripción requerida"]);
    exit;
  }
  $descripcion = $conn->real_escape_string($data['descripcion']);
  $conn->query("INSERT INTO wishes (descripcion) VALUES ('$descripcion')");
  echo json_encode(["message" => "Deseo agregado"]);
  exit;
}

// Eliminar 
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  parse_str(file_get_contents("php://input"), $data);
  if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "ID requerido"]);
    exit;
  }
  $id = intval($data['id']);
  $conn->query("DELETE FROM wishes WHERE id = $id");
  echo json_encode(["message" => "Deseo eliminado"]);
  exit;
}

// Actualizar
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  parse_str(file_get_contents("php://input"), $data);

  if (!isset($data['id']) || !isset($data['descripcion'])) {
    http_response_code(400);
    echo json_encode(["error" => "ID y descripción requeridos"]);
    exit;
  }

  $id = intval($data['id']);
  $descripcion = $conn->real_escape_string($data['descripcion']);

  $conn->query("UPDATE wishes SET descripcion = '$descripcion' WHERE id = $id");

  echo json_encode(["message" => "Deseo actualizado"]);
  exit;
}

