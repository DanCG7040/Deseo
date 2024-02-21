<?php
// Incluir tu script de conexión a la base de datos
include 'conexion_db.php';

$conexion = conectarDB();

// Obtener el ID del producto desde la URL
$productoId = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = "SELECT * FROM producto WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $productoId);
$stmt->execute();
$resultado = $stmt->get_result();

if ($producto = $resultado->fetch_assoc()) {
    echo "<div class='producto'>";
    echo "<h3>" . $producto['nombre'] . "</h3>";
    echo "<p>Descripción: " . $producto['descripcion'] . "</p>";
    echo "<p>Precio: $" . $producto['precio'] . "</p>";
    // Añadir más detalles según sea necesario
    echo "</div>";
}

// Aquí podrías añadir una consulta para mostrar productos relacionados si es necesario
?>
