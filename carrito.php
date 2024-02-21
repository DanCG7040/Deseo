<?php
session_start();

// Inicializar el carrito si no existe en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Vaciar el carrito si se presionó el botón de limpiar
if (isset($_POST['limpiarCarrito'])) {
    $_SESSION['carrito'] = array(); // Establecer el carrito a un array vacío
    header("Location: carrito.php"); // Redirigir para evitar reenvío del formulario
    exit;
}

// Agregar producto al carrito
if (isset($_POST['producto_id']) && isset($_POST['precio'])) {
    $productoId = $_POST['producto_id'];
    $precio = floatval($_POST['precio']); // Asegurarse de que el precio sea un número

    // Agregar o actualizar el producto en el carrito
    if (!isset($_SESSION['carrito'][$productoId])) {
        $_SESSION['carrito'][$productoId] = array('cantidad' => 1, 'precio' => $precio);
    } else {
        $_SESSION['carrito'][$productoId]['cantidad']++;
    }

    header("Location: carrito.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alegreya:ital@1&family=Dancing+Script&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@700&family=Lisu+Bosa:ital@1&family=Merriweather&family=Open+Sans&family=PT+Sans:wght@400;700&family=Playfair+Display:ital@1&display=swap"
 rel="stylesheet">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto Ejemplo</title>
    <link rel="stylesheet" type="text/css" href="../Deseo/css/paginas.css">
    <link rel="stylesheet" type="text/css" href="../Deseo/css/producto.css">
    <link rel="stylesheet" type="text/css" href="../Deseo/css/carrito.css">
<head>
    <!-- Tus enlaces a CSS y fuentes aquí -->
    <title>Deseo - Carrito de Compras</title>
    <!-- Resto del código de tu cabecera -->
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
   // Asegúrate de llamar a session_start() antes de cualquier salida HTML

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

    <section class="carrito">
        <h2>Carrito de Compras</h2>
        <?php
       $total = 0;
       foreach ($_SESSION['carrito'] as $productoId => $detalles) {
           echo "<div class='item-carrito'>";
           // Aquí deberías obtener los detalles del producto por su ID
           // Por ejemplo, el nombre del producto, imagen, etc.
       
           echo "Producto ID: $productoId, Cantidad: " . $detalles['cantidad'] . ", Precio unitario: $" . $detalles['precio'] . "<br>";
       
           // Asegúrate de que ambos, cantidad y precio, sean números
           $cantidad = intval($detalles['cantidad']);
           $precio = floatval($detalles['precio']);
           $subtotal = $cantidad * $precio;
       
           echo "Subtotal: $" . $subtotal . "<br>";
           echo "</div>";
       
           $total += $subtotal;
       }
        echo "<p>Total del carrito: $" . $total . "</p>";
        ?>

        <!-- Formulario para limpiar el carrito -->
        <form action="carrito.php" method="POST">
            <button type="submit" name="limpiarCarrito">Limpiar Carrito</button>
        </form>
        <form action="proceso_compra.php" method="POST">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button type="submit" name="continuarCompra">Continuar Compra</button>
        </form>
    </section>

    <footer class="footer">
        <!-- Tu código de pie de página aquí -->
    </footer>
</body>
</html>
