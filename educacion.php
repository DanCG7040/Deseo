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
 <link rel="stylesheet" href="../Deseo/img/sexual-education-concept-tiny-people-with-big-book-in-sexual-health-lesson-contraception-and-reproduction-system-human-sexuality-modern-flat-cartoon-style-illustration-vector.jpg">
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


         <div class="contenedor contenido-principal">
            <main class="educacion">
                <h4 > consejos para tu bienestar</h4>
                <article class="entrada">
                    <div class="entrada_imagen">
                        <picture>
                            <source srcset="../Deseo/img/fondo.jpg" type="image/webp">
                            <img loading="lazy" src="../Deseo/img/deseo.png" alt="imagen salud">
                        </picture>
                        
                    </div>
    
                    <div class="entrada_contenido">
                        <h3 class="entrada_texto" > tu salud primero
                            <p>"        En Deseo, creemos que una educación sexual positiva y el autocuidado son
                                 fundamentales para disfrutar de una vida sexual satisfactoria y segura. 
                                 Explora nuestra sección 'Tu Salud Primero' y toma el control de tu bienestar sexual. ¡Porque tu salud siempre es lo primero!"</p>
                            <a href="entrada.php" class="  boton--primario">leer entrada</a>
                        </h3>
                    </div>
                </article>
    
                
    
                <article class="entrada">
                    <div class="entrada_imagen">
                        <picture>
                            <source  srcset="../Deseo/img/pornografia.jpg" type="image/webp">
                            <img loading="lazy" src="../Deseo/img/blog2.jpg" alt="imagen blog">
                        </picture>
                       
                    </div>
    
                    <div class="entrada_contenido">
                        <h3 class="no-margin"> Adicción a la Pornografía
                            <p>Algunas personas pueden desarrollar una adicción a la pornografía, lo que puede afectar negativamente su vida diaria y relaciones. La adicción a la pornografía puede requerir tratamiento y apoyo profesional.</p>
                            <a href="pornografia.php" class=" boton--primario">leer entrada</a>
                        </h3>
                    </div>
                </article>
    
                <article class="entrada">
                    <div class="entrada_imagen">
                        <picture>
                            <source srcset="../Deseo/img/condones.png " type="image/webp">
                            <img loading="lazy" src="../Deseo/img/condones.png" alt="imagen blog">
                        </picture>
                        
                    </div>
    
                    <div class="entrada_contenido">
                        <h3 class="no-margin"> El cuidado es lo importante
                            <p>
                                El uso adecuado del preservativo es esencial para la prevención de embarazos no deseados y la protección contra infecciones de transmisión sexual (ITS). Aquí tienes información importante sobre el cuidado y el uso del preservativo:</p>
                            <a href="condones.php" class=" boton--primario">leer entrada</a>
                        </h3>
                    </div>
                </article>
    
                
            </main>
          
        </div>
        
       
        


         <footer class="footer">
            <p>Todos los derechos reservados</p>
        </footer>

</body>
</html>