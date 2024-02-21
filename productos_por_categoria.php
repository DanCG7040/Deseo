<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@700&family=Lisu+Bosa:ital@1&family=Merriweather&family=Open+Sans&family=PT+Sans:wght@400;700&family=Playfair+Display:ital@1&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../Deseo/css/style.css">
    <link rel="stylesheet" href="../Deseo/css/categoria.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <title>Deseo</title>
</head>

<body>
    <!-- ... [Cabecera y Navegación] ... -->
    <header class="header">
        <a href="index.php">
            <img class="header__logo" src="../Deseo/img/deseo.png" alt="deseo.png">
        </a>

        <nav class="navegacion">
            <a class="navegacion__ul" href="categorias.php"><i>Categorias</i></a>
            <a class="navegacion__ul" href="novedades.php">Novedades</a>
            <a class="navegacion__ul" href="educacion.php">Educacion sexual</a>
            <a class="navegacion__ul" href="contacto.php">Contacto</a>

            <a class="navegacion_corazon corazon" href="lista_deseos.php">
                <span class="material-symbols-outlined">
                    heart_plus
                </span>
            </a>

            <a class="navegacion_carrito carro" href="carrito.php">
                <span class="material-symbols-outlined">
                    shopping_cart
                </span>

            </a>

            <?php
    session_start(); // Asegúrate de llamar a session_start() antes de cualquier salida HTML

    // Establecer la URL del perfil dependiendo del rol del usuario
    $perfilUrl = 'sesion.php'; // Página de inicio de sesión por defecto si el usuario no está logueado
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        if ($_SESSION['rol'] === 'admin') {
            $perfilUrl = 'administrador.php'; // Cambiar a la página de perfil del administrador
        } else {
            $perfilUrl = 'perfil.php'; // Cambiar a la página de perfil del usuario
        }
    }
    ?>

            <a class="perfil " href="<?php echo htmlspecialchars($perfilUrl); ?>">
                <span class="material-symbols-outlined">
                    account_circle
                </span>
            </a>

            <!-- Resto del contenido de tu cabecera -->

            <form class="lupa" action="productos_por_categoria.php" method="GET">
    <div class="lupa__buscar">
        <input type="text" name="busqueda" placeholder="Buscar" required />
        <?php if (isset($_GET['categoriaId'])): ?>
            <input type="hidden" name="categoriaId" value="<?php echo htmlspecialchars($_GET['categoriaId']); ?>" />
        <?php endif; ?>
        <button type="submit" class="btn">
            <i class="fas fa-search icon"> <span class="material-symbols-outlined">search</span></i>
        </button>
    </div>
</form>

        </nav>
    </header>
    <?php
// Función para conectar a la base de datos
function conectarDB() {
    $host = 'localhost';
    $usuario = 'root';
    $contrasena = 'admin'; // Reemplaza con tu contraseña real
    $baseDeDatos = 'web';

    $conexion = new mysqli($host, $usuario, $contrasena, $baseDeDatos);
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    return $conexion;
}

$conexion = conectarDB();

// BUSQUEDA
$busqueda = isset($_GET['busqueda']) ? $conexion->real_escape_string($_GET['busqueda']) : '';
$categoriaId = isset($_GET['categoriaId']) ? $conexion->real_escape_string($_GET['categoriaId']) : null;

if ($busqueda != '') {
    // Si hay una búsqueda, usar esta consulta
    $sql = "SELECT p.*, i.contenido AS imagen_contenido
            FROM producto p
            LEFT JOIN imagen_producto i ON p.id = i.producto_id
            WHERE p.nombre LIKE '%$busqueda%'";

    if ($categoriaId) {
        $sql .= " AND p.categoria_id = $categoriaId";
    }

    $sql .= " GROUP BY p.id";
} elseif ($categoriaId) {
    // Si no hay búsqueda pero sí una categoría, usar esta consulta
    $sql = "SELECT p.*, i.contenido AS imagen_contenido
            FROM producto p
            LEFT JOIN imagen_producto i ON p.id = i.producto_id
            WHERE p.categoria_id = $categoriaId
            GROUP BY p.id";
} else {
    // Si no hay búsqueda ni categoría, decidir qué hacer
    // Por ejemplo, podrías mostrar todos los productos o una página de error
}

$resultado = $conexion->query($sql);

// Ahora, iterar sobre los resultados y mostrarlos
while ($producto = $resultado->fetch_assoc()) {
    echo "<div class='producto'>";
    
    // Botón que lleva a la página del producto, o realiza alguna acción
    echo "<a href='productos.php?id=" . $producto['id'] . "' class='button'>";
    echo "<h3>" . htmlspecialchars($producto['nombre']) . "</h3>";
    echo "</a>";

    echo "<p>Precio: $" . htmlspecialchars($producto['precio']) . "</p>";

    if (!empty($producto['imagen_contenido'])) {
        $base64Imagen = base64_encode($producto['imagen_contenido']);
        echo "<div class='imagen_contenido'>";
        echo "<img src='data:image/jpeg;base64," . $base64Imagen . "' alt='Imagen del producto'>";
        echo "</div>";
    }

    // Aquí puedes añadir más detalles del producto, como descripción, botones adicionales, etc.

    echo "</div>"; // Fin del div 'producto'
}

//Cierre BUSQUEDA

if (isset($_GET['categoriaId'])) {
    $categoriaId = $_GET['categoriaId'];

    // Modifica la consulta para incluir el contenido de la imagen
    $sql = "SELECT p.*, i.contenido AS imagen_contenido
            FROM producto p
            LEFT JOIN imagen_producto i ON p.id = i.producto_id
            WHERE p.categoria_id = ?
            GROUP BY p.id"; // Agrupa los resultados por ID del producto

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $categoriaId);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($producto = $resultado->fetch_assoc()) {
        echo "<div class='producto'  class='button'>";
echo "<a  class='button' href='productos.php?id=" . $producto['id'] . "'>";
echo "<h3>" . $producto['nombre'] . "</h3>";
echo "</a>";
        echo "<div class='producto'>";
        echo "<p>Precio: $" . $producto['precio'] . "</p>";
        echo "<p>Disponible: " . ($producto['disponible'] ? 'Sí' : 'No') . "</p>";
        if (!empty($producto['imagen_contenido'])) {
            $base64Imagen = base64_encode($producto['imagen_contenido']);
            echo "<div class='imagen_contenido'>";
            echo "<img src='data:image/jpeg;base64," . $base64Imagen . "' alt='Imagen del producto' class='imagen_contenido'>";
            echo "</div>";

           
        }
        

        echo "</div>"; // Asegúrate de que esto esté dentro del bucle while
    }
}
?>

</body>
<footer class="footer">
    <p>Todos los derechos reservados</p>
</footer>

</html>