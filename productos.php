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


</head>
<body>
    <header class="header">
        <a href="index.php">
        <img  class="header__logo"  src="../Deseo/img/deseo.png" alt="deseo.png">
        </a>
        
         <nav class="navegacion">
                 <a class="navegacion__ul"  href="categorias.php"><i>Categorias</i></a>
                <a class="navegacion__ul" href="novedades.php">Novedades</a>
                <a class="navegacion__ul"   href="educacion.php">Educacion sexual</a>
                <a class="navegacion__ul" href="contacto.php">Contacto</a>
            
                <a class="navegacion_corazon corazon"  href="lista_deseos.html">
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
    $usuarioLogueado = false; // Añadir una variable para verificar si el usuario está logueado

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $usuarioLogueado = true; // Establecer como true si el usuario está logueado
        if ($_SESSION['rol'] === 'admin') {
            $perfilUrl = 'administrador.php'; // Cambiar a la página de perfil del administrador
        } else {
            $perfilUrl = 'perfil.php'; // Cambiar a la página de perfil del usuario
        }
    }
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
                  
                 
       
            <form class="lupa">
                <div class="lupa__buscar">
                    <input type="text" placeholder="Buscar" required />
              
                    <div class="btn">
                      <i class="fas fa-search icon"> <span class="material-symbols-outlined">
                        search
                        </span></i>
                    </div>
            
          </form></div>

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

$productoId = isset($_GET['id']) ? $_GET['id'] : 0;

// Obtener los detalles del producto
$sqlProducto = "SELECT * FROM producto WHERE id = ?";
$stmtProducto = $conexion->prepare($sqlProducto);
$stmtProducto->bind_param("i", $productoId);
$stmtProducto->execute();
$resultadoProducto = $stmtProducto->get_result();

if ($producto = $resultadoProducto->fetch_assoc()) {
    echo "<div class='producto'>";
    echo "<h3>" . $producto['nombre'] . "</h3>";
    echo "<p>Descripción: " . $producto['descripcion'] . "</p>";
    echo "<p>Especificaciones: " . $producto['especificaciones'] . "</p>";
    echo "<p>Precio: $" . $producto['precio'] . "</p>";
    




    // Obtener las imágenes del producto
    $sqlImagenes = "SELECT contenido AS imagen_contenido FROM imagen_producto WHERE producto_id = ?";
    $stmtImagenes = $conexion->prepare($sqlImagenes);
    $stmtImagenes->bind_param("i", $productoId);
    $stmtImagenes->execute();
    $resultadoImagenes = $stmtImagenes->get_result();

    $imagenes = [];
    while ($imagen = $resultadoImagenes->fetch_assoc()) {
        if (!empty($imagen['imagen_contenido'])) {
            $imagenes[] = base64_encode($imagen['imagen_contenido']);
        }
    }

    // Mostrar la imagen principal y las miniaturas
    if (!empty($imagenes)) {
        echo "<div id='imagenPrincipal' class='imagen-principal'>";
        echo "<img src='data:image/jpeg;base64," . $imagenes[0] . "' alt='Imagen del producto'>";
        echo "</div>";

        if (count($imagenes) > 1) {
            echo "<div class='miniaturas'>";
            foreach ($imagenes as $index => $base64Imagen) {
                echo "<img src='data:image/jpeg;base64," . $base64Imagen . "' alt='Imagen del producto' class='miniatura' onclick='cambiarImagen(" . $index . ")'>";
            }
            echo "</div>";
        }
    }

    // Verificar si el usuario ha iniciado sesión para mostrar el botón de agregar al carrito
    if ($usuarioLogueado) {
        // Mostrar el formulario para agregar al carrito
        echo "<form action='carrito.php' method='POST'>";
        echo "<input type='hidden' name='producto_id' value='" . $producto['id'] . "'>";
        echo "<input type='hidden' name='precio' value='" . $producto['precio'] . "'>";
        echo "<button type='submit'>Agregar al carrito</button>";
        echo "</form>";
    } else {
        // Opcionalmente, mostrar un mensaje para iniciar sesión
        echo "<p>Por favor, <a href='iniciar_sesion.php'>inicia sesión</a> para agregar productos al carrito.</p>";
    }
    

    if ($usuarioLogueado) {
        // Mostrar el formulario para agregar a lista de deseos
        echo "<form action='lista_deseos.php' method='POST'>";
        echo "<input type='hidden' name='producto_id' value='" . $producto['id'] . "'>";
        echo "<input type='hidden' name='precio' value='" . $producto['precio'] . "'>";
        echo "<button type='submit'>Agregar a lista deseos</button>";
        echo "</form>";
    } else {
        // Opcionalmente, mostrar un mensaje para iniciar sesión
        echo "<p>Por favor, <a href='iniciar_sesion.php'>inicia sesión</a> para agregar productos a la lista de deseos.</p>";
    }

    echo "</div>"; // Fin del div producto
} else {
    echo "Producto no encontrado.";
}
// Obtener productos recomendados
$sqlRecomendados = "SELECT p.id, p.nombre, i.contenido AS imagen_contenido 
                    FROM producto p 
                    LEFT JOIN imagen_producto i ON p.id = i.producto_id 
                    GROUP BY p.id 
                    ORDER BY RAND() 
                    LIMIT 4";
$stmtRecomendados = $conexion->prepare($sqlRecomendados);
$stmtRecomendados->execute();
$resultadoRecomendados = $stmtRecomendados->get_result();



echo "<div class='productos-recomendados'>";
echo "<h3>Productos Recomendados</h3>";
while ($productoRecomendado = $resultadoRecomendados->fetch_assoc()) {
    echo "<div class='producto-recomendado'>";
    echo "<a href='productos.php?id=" . $productoRecomendado['id'] . "'>";
    if (!empty($productoRecomendado['imagen_contenido'])) {
        $imagenBase64 = base64_encode($productoRecomendado['imagen_contenido']);
        echo "<img src='data:image/jpeg;base64," . $imagenBase64 . "' alt='Imagen del producto'>";
    }
    echo "<h4>" . $productoRecomendado['nombre'] . "</h4>";
    echo "</a>";
    echo "</div>";
}
echo "</div>";;

$conexion->close();
?>




<script>

function agregarAlCarrito(productoId, precio) {
        // Aquí puedes agregar la lógica para enviar la información al carrito
        console.log("Producto agregado: ", productoId, " Precio: ", precio);
        // Redirigir al usuario al carrito o mostrar mensaje de confirmación
    }
function cambiarImagen(index) {
    var todasLasImagenes = document.querySelectorAll('.miniatura');
    var imagenPrincipal = document.getElementById('imagenPrincipal').querySelector('img');
    imagenPrincipal.src = todasLasImagenes[index].src;
}
</script>



</body>
</html>




</body>
</html>