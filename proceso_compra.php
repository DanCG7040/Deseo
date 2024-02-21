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
  <main class="carrito">
     <?php

// Verificar si se presionó el botón de continuar compra
if (isset($_POST['continuarCompra'])) {
    // Obtener el total del carrito desde el formulario del carrito.php
    $totalCarrito = floatval($_POST['total']);
    // Calcular el precio de envío (puedes ajustar esto según tus necesidades)
    $precioEnvio = 5.0; // Supongamos que el envío cuesta $5
    // Sumar el precio de envío al total del carrito
    $totalConEnvio = $totalCarrito + $precioEnvio;
    // Mostrar el total con envío
    echo "<h2>Continuar Compra</h2>";
    echo "Total del carrito: $" . $totalCarrito . "<br>";
    echo "Precio de Envío: $" . $precioEnvio . "<br>";
    echo "Total con Envío: $" . $totalConEnvio . "<br>";
    // Agregar el formulario para seleccionar el método de pago
    echo "<form action='proceso_compra.php' method='POST' onsubmit='mostrarMensajeCompraExitosa()'>";
    echo "<label for='metodoPago'>Seleccione el método de pago:</label>";
    echo "<select name='metodoPago' id='metodoPago'>";
    echo "<option value='nequi'>Nequi</option>";
    echo "<option value='contraentrega'>Contraentrega</option>";
    echo "<option value='daviplata'>Daviplata</option>";
    echo "</select>";
    echo "<button type='submit' name='finalizarCompra' onclick='mostrarMensajeCompraExitosa()'>Finalizar Compra</button>";
    echo "</form>";
} else {
    // Si alguien intenta acceder directamente a este archivo sin continuar desde el carrito, redirige al carrito.php
    header("Location: carrito.php");
    exit;
}
?>

<script>
function mostrarMensajeCompraExitosa() {
  event.preventDefault(); // Evita que el formulario se envíe inmediatamente
  alert("Compra exitosa!");
  setTimeout(function() {
    // Redirigir a index.php después de mostrar el mensaje
    window.location.href = "index.php";
  }, 3000);
}
</script>
</main>
</body>
</html>

