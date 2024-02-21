<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', 'admin', 'web');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener productos con imágenes
$sql = "SELECT p.*, i.contenido AS imagen_contenido FROM producto p
        LEFT JOIN imagen_producto i ON p.id = i.producto_id";
$resultado = $conexion->query($sql);

// Generar HTML para cada producto con imágenes
if ($resultado->num_rows > 0) {
    // Procesar cada fila del resultado
    while($producto = $resultado->fetch_assoc()) {
        echo "<div class='producto'>";
        echo "<h3>" . htmlspecialchars($producto['nombre']) . "</h3>";
        echo "<p>" . htmlspecialchars($producto['descripcion']) . "</p>";
        echo "<p>Precio: $" . htmlspecialchars($producto['precio']) . "</p>";

        // Mostrar imagen si está disponible
        if ($producto['imagen_contenido']) {
            $base64Imagen = base64_encode($producto['imagen_contenido']);
            echo "<img src='data:image/jpeg;base64,{$base64Imagen}' alt='Imagen del producto'>";
        }

        // Aquí puedes agregar más elementos HTML, como botones
        echo "</div>";
    }
} else {
    echo "No se encontraron productos.";
}

// Cerrar la conexión
$conexion->close();
?>