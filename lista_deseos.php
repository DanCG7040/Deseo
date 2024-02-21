<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@700&family=Lisu+Bosa:ital@1&family=Merriweather&family=Open+Sans&family=PT+Sans:wght@400;700&family=Playfair+Display:ital@1&display=swap"
 rel="stylesheet">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link rel="stylesheet" href="../Deseo/css/style.css">
 <link rel="stylesheet" href="../Deseo/css/carrito.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <title>Deseo</title>
</head>
<body>
    
<header class="header">
        <a href="index.php">
        <img class="header__logo"  src="../Deseo/img/deseo.png" alt="deseo.png">
        </a>
        
         <nav class="navegacion">
                 <a class="navegacion__ul"  href="categorias.php"><i>Categorias</i></a>
                <a class="navegacion__ul" href="novedades.php">Novedades</a>
                <a class="navegacion__ul"   href="educacion.php">Educacion sexual</a>
                <a class="navegacion__ul" href="contacto.php">Contacto</a>
            
                <a class="navegacion_corazon corazon"  href="lista_deseos.php">
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


    <!-- Comienzo código de la página -->
    
      <section>
        <p class="titulo">Lista de Deseos</p>
      </section>
      <?php


// Inicializar el carrito si no existe en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id']) && isset($_POST['precio'])) {
        $productoId = $_POST['producto_id'];
        $precio = $_POST['precio'];

        // Agregar o actualizar el producto en el carrito
        if (!isset($_SESSION['carrito'][$productoId])) {
            $_SESSION['carrito'][$productoId] = array('cantidad' => 1, 'precio' => $precio);
        } else {
            $_SESSION['carrito'][$productoId]['cantidad']++;
        }

        // Redirigir al usuario de vuelta a la página del carrito
        header("Location: lista_deseos.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <!-- Tus enlaces a CSS y fuentes aquí -->
    <title>Deseo - favoritos</title>
    <!-- Resto del código de tu cabecera -->
</head>
<body>
    <header class="header">
        <!-- Tu código de cabecera aquí -->
    </header>

    <section class="carrito">

        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $productoId => $detalles) {
            echo "<div class='item-carrito'>";
            // Aquí deberías obtener los detalles del producto por su ID
            // Por ejemplo, el nombre del producto, imagen, etc.

            echo "Producto ID: $productoId, Cantidad: " . $detalles['cantidad'] . ", Precio unitario: $" . $detalles['precio'] . "<br>";
            $subtotal = $detalles['cantidad'] * $detalles['precio'];
            echo "Subtotal: $" . $subtotal . "<br>";
            echo "</div>";

            $total += $subtotal;
        }
        // echo "<p>Total del carrito: $" . $total . "</p>";
        ?>
    </section>

    <footer class="footer">
        <!-- Tu código de pie de página aquí -->
    </footer>
</body>
</html>



    <footer class="footer">
        <p>Todos los derechos reservados</p>
    </footer>

</body>
</html>