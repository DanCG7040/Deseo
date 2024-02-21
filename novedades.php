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

         <!-- INICIO CÓDIGO NOVEDADES -->
         <section class="novedades">
        <p class="titulo">Lista de novedades</p>

        <?php
            // Conexión con la base de datos
            $conexion = new mysqli("localhost", "root", "admin", "web");
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Consulta para obtener los productos más recientes
            $sql = "SELECT p.*, i.contenido AS imagen_contenido
                    FROM producto p
                    LEFT JOIN imagen_producto i ON p.id = i.producto_id
                    ORDER BY p.id DESC LIMIT 10"; // Ajusta el límite según lo que desees mostrar
            $resultado = $conexion->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                while ($producto = $resultado->fetch_assoc()) {
                    echo "<div class='producto'>";
                    echo "<a href='productos.php?id=" . $producto['id'] . "'>";
                    echo "<h3>" . htmlspecialchars($producto['nombre']) . "</h3>";
                    echo "</a>";
                    echo "<p>Precio: $" . htmlspecialchars($producto['precio']) . "</p>";
                    echo "<p>Disponible: " . ($producto['disponible'] ? 'Sí' : 'No') . "</p>";

                    if (!empty($producto['imagen_contenido'])) {
                        $base64Imagen = base64_encode($producto['imagen_contenido']);
                        echo "<div class='imagen_producto'>";
                        echo "<img src='data:image/jpeg;base64," . $base64Imagen . "' alt='Imagen del producto'>";
                        echo "</div>";
                    } else {
                        echo "<p>Imagen no disponible.</p>";
                    }
                    echo "</div>"; // Fin del div producto
                }
            } else {
                echo "<p>No hay novedades disponibles.</p>";
            }

            $conexion->close();
        ?>
         <div class="novedadesP">

            <!-- AQUÍ SE AGREGARAN LOS MÁS RECIENTES PRODUCTOS -->

         </div>

         <footer class="footer">
            <p>Todos los derechos reservados</p>
        </footer>

</body>
</html>