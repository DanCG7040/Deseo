<?php
include 'perfil.html.php';


session_start();

// Asegúrate de que el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
$_SESSION['nombre_usuario'] = $user['nombre'];

// Conexión a la base de datos (puedes reutilizar el código de conexión)
$host = 'localhost';
$db   = 'registro';
$user = 'root';
$pass = 'admin';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Obtener los detalles del usuario
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_usuario]);
$user = $stmt->fetch();

// Luego puedes usar $user para acceder a los datos del usuario
?>
