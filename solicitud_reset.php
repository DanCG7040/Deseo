<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "admin", "web");

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT id FROM usuario WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Generar un token único
        $token = bin2hex(random_bytes(32));

        // Almacenar el token en la base de datos y establecer su fecha de expiración
        $fecha_expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $sql = "UPDATE usuario SET reset_token = ?, token_expiration = ? WHERE email = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sss", $token, $fecha_expiracion, $email);
        $stmt->execute();

        // Enviar el token al email del usuario
        $enlace = "http://tusitio.com/resetear_contraseña.php?token=" . $token;
        $mensaje = "Para restablecer tu contraseña, haz clic en el siguiente enlace: " . $enlace;

        // Aquí debes implementar el envío del email electrónico
        mail($email, "Restablecimiento de Contraseña", $mensaje);

        echo "Si tu email electrónico está registrado, recibirás un enlace para restablecer tu contraseña.";
    } else {
        echo "Si tu email electrónico está registrado, recibirás un enlace para restablecer tu contraseña.";
    }
} else {
    // Formulario HTML para solicitar el email electrónico del usuario

?>
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
 <link rel="stylesheet" href="../Deseo/css/contacto.css">
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
        <h2>Solicitar Restablecimiento de Contraseña</h2>
        <form action="solicitud_reset.php" method="post">
            <label class="contenidoss" for="email">email Electrónico:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Solicitar Restablecimiento">
        </form>
    </body>
    </html>
<?php
}
?>
