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
    
                  
                 
       
                <<form class="lupa" action="productos_por_categoria.php" method="GET">
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

        
         <section>
            <h2>Contacto</h2>
        
            <form class="formulario" action="https://formsubmit.co/tillasistemas@gmail.com" method="post"> 
                <!-- Campo oculto para la redirección -->
            <input type="hidden" name="_next" value="http://localhost/Deseo/index.php">
        
        <fieldset>
        
        <legend>Contáctanos llenando todos los campos</legend>
        
        <div class="contenedor-campos">
        <div class="campo">
            <label>Nombre</label>
            <input class="input-text" type="text" name="nombre" placeholder="Tú nombre">
        </div>
        
        <div class="campo">
            <label>Telefono</label>
            <input class="input-text" type="text" name="telefono" placeholder="Tú telefono">
        </div>
        
        <div class="campo">
            <label>Email</label>
            <input class="input-text" type="text" name="email"placeholder="Tú correo">
        </div>
        
        <div class="campo">
            <label>Mensaje</label>
            <textarea class="input-text" name="mensaje"></textarea>
        </div>
        </div>  <!-- contenedor campos -->
        
        <div class="alinear-derecha flex">
            <input class="boton w-sm-100" type="submit" value="Enviar">
        </div>
        
        
        </fieldset>
        
        </form>
        
        </section>

        <footer class="footer">
            <p>Todos los derechos reservados</p>
        </footer>

    </body>
    </html>