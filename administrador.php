<?php
$host = 'localhost';
$db = 'web';
$user = 'root';
$pass = 'admin';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

session_start();

// Procesamiento del formulario de agregar producto
if (isset($_POST['submit']) && $_POST['submit'] == 'Agregar Producto') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria_id = $_POST['categoria_id']; // Asegúrate de que este campo existe en tu formulario
    $disponible = 1; // Asumiendo que todos los productos nuevos están disponibles

    // Insertar producto
    $stmt = $pdo->prepare("INSERT INTO producto (nombre, descripcion, precio, disponible, categoria_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $precio, $disponible, $categoria_id]);

    // Insertar imagen si se sube una
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $producto_id = $pdo->lastInsertId();
        $imagen = $_FILES['imagen']['tmp_name'];

        // Guardar la imagen en la base de datos
        $stmtImg = $pdo->prepare("INSERT INTO imagen_producto (producto_id, contenido) VALUES (?, ?)");
        $imagenContenido = file_get_contents($imagen);
        $stmtImg->execute([$producto_id, $imagenContenido]);
    }

    echo "Producto agregado con éxito";
}



// Procesar el formulario de editar producto
if (isset($_POST['editar'])) {
    // Obtener los datos del formulario
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria_id = $_POST['categoria_id']; // Cambiado a categoria_id

    // Actualizar el producto en la base de datos
    $stmt = $pdo->prepare("UPDATE producto SET nombre=?, descripcion=?, precio=?, categoria_id=? WHERE id=?");
    $stmt->execute([$nombre, $descripcion, $precio, $categoria_id, $id_producto]);

    echo "Producto actualizado con éxito";
}


// Procesar el formulario de eliminar producto
// Procesar el formulario de eliminar producto
// Procesar el formulario de eliminar producto
if (isset($_POST['eliminar'])) {
    // Obtener el ID del producto
    $id_producto = $_POST['id_producto'];

    // Primero, eliminar todas las imágenes asociadas con este producto
    $stmtImg = $pdo->prepare("DELETE FROM imagen_producto WHERE producto_id=?");
    $stmtImg->execute([$id_producto]);

    // Luego, eliminar el producto de la base de datos
    $stmt = $pdo->prepare("DELETE FROM producto WHERE id=?");
    $stmt->execute([$id_producto]);

    echo "Producto eliminado con éxito";
}

?>

1
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
    <link rel="stylesheet" href="../Deseo/css/contacto.css">
    <link rel="stylesheet" href="../Deseo/css/style.css">
    <link rel="stylesheet" href="../Deseo/css/perfil.css">
    <link rel="stylesheet" href="../Deseo/css/carrito.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <title>Deseo</title>
</head>

<body>

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


            // Establecer la URL del perfil dependiendo del rol del usuario
            $perfilUrl = 'sesion.php'; // Página de inicio de sesión por defecto si el usuario no está logueado
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                if ($_SESSION['rol'] === 'admin') {
                    $perfilUrl = 'administrador.php'; // Cambiar a la página de perfil del administrador
                } else {
                    $perfilUrl = 'perfil.php'; // Cambiar a la página de perfil del usuario
                }
            }
            if (isset($_POST['submit'])) {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $categoria = $_POST['categoria_id'];


                // Procesar la imagen cargada
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                    $imagen = $_FILES['imagen']['tmp_name'];
                    $imagenContenido = addslashes(file_get_contents($imagen));

                    // Aquí tu código para insertar el producto y la imagen en la base de datos
                    $sql = "INSERT INTO producto (nombre, descripcion, precio, categoria, stock) VALUES (?, ?, ?, ?, ?)";
                    // ... Preparar y ejecutar la consulta ...
            
                    $sqlImagen = "INSERT INTO imagen_producto (producto_id, contenido) VALUES (?, ?)";
                    // ... Preparar y ejecutar la consulta para la imagen ...
                }
            }
            ?>



            <a class="perfil " href="<?php echo htmlspecialchars($perfilUrl); ?>">
                <span class="material-symbols-outlined">
                    account_circle
                </span>
            </a>

            <!-- Resto del contenido de tu cabecera -->




           
            </div>

        </nav>
    </header>

    <h1>Panel de Administración</h1>
    <div class="carrito" >
    <!-- Formulario para agregar productos -->
    <h2>Agregar Producto</h2>
    <form action="administrador.php" method="post" enctype="multipart/form-data">
        Nombre: <input type="text" name="nombre"><br>
        Descripción: <textarea name="descripcion"></textarea><br>
        Precio: <input type="number" name="precio" step="0.01"><br>
        Categoría ID: <input type="number" name="categoria_id"><br>
        Imagen: <input type="file" name="imagen"><br>
        <input type="submit" name="submit" value="Agregar Producto">
    </form>





    <!-- Formulario para editar productos -->
    <h2>Editar Producto</h2>
    <form action="administrador.php" method="post">
        ID del Producto: <input type="number" name="id_producto"><br>
        Nombre: <input type="text" name="nombre"><br>
        Descripción: <textarea name="descripcion"></textarea><br>
        Precio: <input type="number" name="precio" step="0.01"><br>
        Categoría ID: <input type="number" name="categoria_id"><br>
        <input type="submit" name="editar" value="Editar Producto">
    </form>

    <!-- Formulario para eliminar productos -->
    <h2>Eliminar Producto</h2>
    <form action="administrador.php" method="post">
        ID del Producto: <input type="number" name="id_producto"><br>
        <input type="submit" name="eliminar" value="Eliminar Producto">
    </form>

    <div id="logoutt" >
        <li><a class="logouttt" href="cerrar_sesion.php">Cerrar sesión</a></li>
    </div>
  
    </div>


</body>
<footer class="footer">
            <p>Todos los derechos reservados</p>
        </footer>
</html>