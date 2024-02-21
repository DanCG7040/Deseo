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

         <main class="contenedor-principal">
            <h3 class="centrar-texto"> Bienestar y salud </h3>
            
            <section class="sidebar-1">
                
                
                <div class="page3">
                    <img src="../Deseo/img/Condón 1_2.jpg" alt="blog1">
                    
               
                    <p>Los preservativos están disponibles en diferentes tipos, incluyendo preservativos de látex, poliuretano y poliisopreno. Los preservativos de látex son los más comunes y ofrecen una alta protección contra las infecciones de transmisión sexual (ITS) y el embarazo. Los preservativos de poliuretano y poliisopreno son opciones para personas alérgicas al látex.
                        
                    </p>

                    <img src="../Deseo/img/descarga.jpg" alt="condon">
                    <img src="../Deseo/img/con.jpg" alt="">
               
                    

                    
                </div>
                <div class="page20">
                <h2>Condon Masculino: </h2>
               <img src="../Deseo/img/condon masculino.png" alt="condon masculino"></p>
            </div>
            </section>
            
            <section>
                <div class="page2"><p>Los preservativos son una herramienta esencial para la salud sexual y reproductiva, y su uso adecuado puede contribuir a relaciones sexuales más seguras y saludables. Es importante que cada persona elija la opción de preservativo que mejor se adapte a sus necesidades y que se sienta cómoda usando. Además, la comunicación abierta sobre la protección y la salud sexual con la pareja es clave para una experiencia sexual segura y placentera.
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/R3YKF5_EBro?si=hsxx0s6LlsizBNn7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>  
                </p>
                    <img src="../Deseo/img/collage-peces-revers-sexe.jpeg" alt="">
                    </div>
                
                <h1>Educación Sexual Basada en la Realidad:</h1>
                
                <div class="blog3">
                    <img class="blog3_img" src="../Deseo/img/condones.png" alt="placer">
                    <p> Los preservativos vienen en diferentes tallas y ajustes para adaptarse a las necesidades individuales. Es importante elegir un preservativo que se ajuste cómodamente y no esté demasiado apretado ni demasiado suelto. Un preservativo que se ajusta adecuadamente es más eficaz y cómodo de usar.</p>
                    <p>Los preservativos son una opción anticonceptiva efectiva para prevenir el embarazo. Deben utilizarse en cada acto sexual, desde el principio hasta el final de la relación sexual, para garantizar una protección óptima contra el embarazo.</p>
                   
                </div>
                
            
              
                
                
            </section>
        </main>