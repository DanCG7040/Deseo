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

// Obtener los detalles del usuario
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuario WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_usuario]);
$user = $stmt->fetch();

// Establecer la variable de sesión aquí
if (isset($user['nombre'])) {
    $_SESSION['nombre_usuario'] = $user['nombre'];
}


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
 <link rel="stylesheet" href="../Deseo/css/style.css">
 <link rel="stylesheet" href="../Deseo/css/perfil.css">
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
                    <a class="perfil " href="perfil.php">
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
    <main>
        
        <div class="profile">
            <section class="user-data">
                <h2>Información de su cuenta</h2>
                <ul class="profile__name" >
                    <li ><strong class="persona">Nombre: <?php echo $_SESSION['nombre_usuario']; ?></strong></li>
                </ul>
            </section>
            <section class="profile-actions"> <!-- Added class "profile-actions" -->
                <h2 class="profile__titulo">Acciones</h2>
                <ul class="profile__actions">
                    <li><a  href="editar_perfil.php">Editar perfil</a></li>
                 <li><a  id="logout"  href="cerrar_sesion.php">Cerrar sesión</a></li> 
                </ul>
            </section>
        </div>
    </main>
</body>
<footer class="footer">
    <p>Todos los derechos reservados</p>
</footer>
</html>