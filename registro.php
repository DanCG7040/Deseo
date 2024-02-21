<?php
// Conexión a la base de datos
$host = 'localhost';
$db   = 'web';  // Reemplaza con el nombre de tu base de datos
$user = 'root';  // Reemplaza con tu usuario de MySQL
$pass = 'admin';  // Reemplaza con tu contraseña de MySQL
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Registro de usuarios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);  // Encripta la contraseña

    // Verificar si el correo electrónico ya existe
    $consulta = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $pdo->prepare($consulta);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "El correo electrónico ya está registrado. Por favor, elige otro.";
        header("Refresh:3; url=registrarse.html");
        exit;
    }

    // Insertar el nuevo usuario en la base de datos
     $sql = "INSERT INTO usuario (nombre, apellido, usuario, email, contraseña) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellido, $usuario, $email, $contraseña]);

    // Registro exitoso
    echo '<script>alert("Usuario registrado con éxito!");</script>';
    echo '<script>window.location = "sesion.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlaces a las fuentes de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@700&family=Lisu+Bosa:ital@1&family=Merriweather&family=Open+Sans&family=PT+Sans:wght@400;700&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <!-- Enlaces a estilos CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.2/normalize.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Deseo/css/registro.css"> 
    <link rel="stylesheet" href="../Deseo/css/style.css"> 
    <title>Deseo</title>
    <style>
        .tab {
            display: none;
        }
        .tab.active {
            display: block;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="index.php">
            <img class="header__logo"  src="../Deseo/img/deseo.png" alt="deseo.png">
        </a>
        <nav class="navegacion">
            <a class="navegacion__ul"  href="categorias.php"><i>Categorias</i></a>
            <a class="navegacion__ul" href="novedades.php">Novedades</a>
            <a class="navegacion__ul"   href="educacion.php">Educación sexual</a>
            <a class="navegacion__ul" href="contacto.php">Contacto</a>
        </nav>
    </header>
    <!-- Formularios -->
    <div class="contenedor-formularios">
        <!-- Links de los formularios -->
        <ul class="contenedor-tabs">
            <li class="tab tab-primera active"><a href="#registrarse"></a></li>
        </ul>
        <!-- Contenido de los Formularios -->

            <!-- Registrarse -->
<div id="registrarse" class="tab active">
    <!-- Contenido del formulario de registro -->
    <h1 id="title">Registrarse</h1>
    <form action="registro.php" method="post">
        <div class="fila-arriba">
            <div class="contenedor-input">
                <label>
                    Nombre <span class="req">*</span>
                </label>
                <input type="text" name="nombre" required>
            </div>
            <div class="contenedor-input">
                <label>
                    Apellido <span class="req">*</span>
                </label>
                <input type="text" name="apellido" required>
            </div>
        </div>
        <div class="contenedor-input">
            <label>
                Usuario <span class="req">*</span>
            </label>
            <input type="text" name="usuario" required>
        </div>
        <div class="contenedor-input">
            <label>
                Email <span class="req">*</span>
            </label>
            <input type="email" name="email" required>
        </div>
        <div class="contenedor-input">
            <label>
                Contraseña <span class="req">*</span>
            </label>
            <input type="password" name="contraseña" required>
        </div>
        
        <input type="submit" class="button button-block" value="Registrarse">
    </form>
</div>
</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/main.js"></script>
<script>
    const tabLinks = document.querySelectorAll('.contenedor-tabs li');
    const tabs = document.querySelectorAll('.tab');
    tabLinks.forEach((link) => {
        link.addEventListener('click', () => {
            const tabId = link.querySelector('a').getAttribute('href');
            tabs.forEach((tab) => {
                if (tab.getAttribute('id') === tabId) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
        });
    });

    // Este es el código que se encarga de mostrar el mensaje cuando el parámetro 'registrado' es 'true'
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('registrado') === 'true') {
            alert('USUARIO REGISTRADO');
        }
    });
</script>

</body>
<footer class="footer">
    <p>Todos los derechos reservados</p>
</footer>
</html>