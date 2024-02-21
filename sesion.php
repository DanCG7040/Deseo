<?php


session_start();
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
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirigir según el rol
    if ($_SESSION['rol'] === 'admin') {
        header("Location: administrador.php");
    } else {
        header("Location: perfil.php");
    }
    exit;
}

// Código de conexión
// ... (tu código de conexión se mantiene igual)

// Inicio de sesión de usuarios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Buscar al usuario por nombre de usuario o email
    $sql = "SELECT * FROM usuario WHERE usuario = ? OR email = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$usuario, $usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($contraseña, $user['contraseña'])) {
        // Iniciar la sesión para el usuario y redirigirlo según su rol
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['id_usuario'] = $user['id'];
        $_SESSION['nombre_usuario'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol']; // Guardar el rol en la sesión

        if ($user['rol'] === 'admin') {
            header("Location: administrador.php"); // Redirigir al administrador
        } else {
            header("Location: perfil.php"); // Redirigir al cliente
        }
        exit;
    } else {
        echo "Error: El nombre de usuario o la contraseña son incorrectos.";
    }
    
}

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
 <link rel="stylesheet" href="../Deseo/css/sesion.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.2/normalize.css"/>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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

        </nav>
		 </header>
     <main><div class="login-wrapper">
       
    <form action="sesion.php" method="post">
        <h1><span>inicar</span> sesion.</h1>

        <div class="input-row">
            <span class="icon"><i class="fa fa-at"></i></span>
            <input type="text" placeholder="id" name="usuario"/>
        </div>

        <div class="input-row">
            <span class="icon"><i class="fa fa-lock"></i></span>
            <input type="password" placeholder="Password" name="contraseña"/>
        </div>

        <div class="submit-row">
            <input type="submit" value="iniciar &raquo;"/>
            <span class="reset"> <a href="solicitud_reset.php">olvide mi contraseña</a></span>
            <a class="submit" href="registro.php">registrate</a>
        </div>
    </form>
        
  </div></main>
     
     

        


</body>
</html>