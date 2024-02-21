<?php
$servername = "tu_servidor";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "SexShopDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$accion = $_POST['accion'];

switch ($accion) {
    case "agregar":
        agregarProducto($conn);
        break;
    case "editar":
        editarProducto($conn);
        break;
    case "eliminar":
        eliminarProducto($conn);
        break;
    default:
        echo "Acción no válida.";
}

function agregarProducto($conn) {
    // Aquí va la lógica para agregar un producto
    // Similar al código que proporcioné anteriormente
}

function editarProducto($conn) {
    // Aquí va la lógica para editar un producto
    // Asegúrate de validar si el producto existe antes de intentar editarlo
}

function eliminarProducto($conn) {
    // Aquí va la lógica para eliminar un producto
    $id_producto = $_POST['id_producto'];

    $stmt = $conn->prepare("DELETE FROM Productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute()) {
        echo "Producto eliminado con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
