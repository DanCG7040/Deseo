<?php
error_reporting(E_ALL);

// Código de conexión
$host = 'localhost';
$db   = 'web';
$user = 'root';
$pass = 'admin';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

session_start();

// Asegúrate de que el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: sesion.php");
    exit;
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id_usuario'];
    $nombre = $_POST['nombre'] ?? ''; // Usa el operador de fusión de null si no estás seguro de que el campo estará presente
    $email = $_POST['email'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $confirmar_contrasena = $_POST['confirmar_contrasena'] ?? '';

    $errores = [];
    // Valida y actualiza el nombre y el email
    if (!empty($nombre)) {
        // Aquí puedes agregar validaciones para el nombre
        $sql = "UPDATE usuario SET nombre = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $id_usuario]);
    }

    if (!empty($email)) {
        // Aquí puedes agregar validaciones para el email
        $sql = "UPDATE usuario SET email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $id_usuario]);
    }

    // Valida y actualiza la contraseña
    if (!empty($contrasena) && !empty($confirmar_contrasena)) {
        if ($contrasena === $confirmar_contrasena) {
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET contraseña = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$contrasena_hash, $id_usuario]);
        } else {
            $errores[] = "Las contraseñas no coinciden.";
        }
    }
    if (count($errores) == 0) {
        header("Location: perfil.php"); // Asegúrate de que 'perfil.php' sea la ruta correcta a tu página de perfil
        exit; // Es importante llamar a exit después de una redirección para detener la ejecución del script
    }

    // Manejar errores o confirmar actualización
    if (count($errores) > 0) {
        // Manejar la presentación de errores
        foreach ($errores as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        echo "<p>Perfil actualizado con éxito.</p>";
    }
}

// Incluye tu formulario de edición de perfil aquí, o redirige a otra página si es necesario
// Por ejemplo: include 'editar_perfil_form.html';
?>
<!DOCTYPE html>
<html lang="es" translate="no">
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
 <link rel="stylesheet" href="../Deseo/css/contacto.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <title>Perfil de Usuario - Deseo</title>
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


    // Establecer la URL del perfil dependiendo del rol del usuario
    $perfilUrl = 'login.php'; // Página de inicio de sesión por defecto si el usuario no está logueado
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
    
                  
                 
       
                </div>

        </nav>
		 </header>
    <body>
        <h2>Editar Perfil</h2>
    
        <form class="formulario" action="editar_perfil.php" method="post">
            <div class="contenedor-campos">
                <div class="campo">
            <label class="campo" for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre"><br>
        </div>
        <div class="campo">
            <label class="campo" for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
        </div>
            <div class="campo">
            <label class="campo" for="contrasena">Nueva Contraseña:</label><br>
            <input type="password" id="contrasena" name="contrasena"><br>
        </div>
            <div class="campo">
            <label class="campo" for="confirmar_contrasena">Confirmar Nueva Contraseña:</label><br>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena"><br>
        </div>
        </div>
        <div class="alinear-derecha flex">
            <input class="boton w-sm-100" type="submit" value="Actualizar Perfil">
        </div>
        </form>
    </body>
    <footer class="footer">
        <p>Todos los derechos reservados</p>
    </footer>
    </html>
