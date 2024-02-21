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


         <main class="contenedor">
            <h3 class="centrar-texto"> Bienestar y salud </h3>
            
            <section>
                
                
                <div class="page2">
                    <img src="../Deseo/img/adultos.jpg" alt="blog1">
                    <img src="../Deseo/img/La-sexualidad-mas-alla-de-la-genitalidad-1.jpg" alt="">
               
               
                    <p>A menudo, los jóvenes se exponen a la pornografía en línea. Es importante hablar sobre la diferencia entre la pornografía y las relaciones sexuales reales, así como sus implicaciones en la percepción de las relaciones sexuales.
                        
                    </p>
                    

                    
                </div>
                <div class="page20">
                <h2>Autoconciencia y Autoreflexión: </h2>
                <p>Tómate el tiempo para reflexionar sobre tu consumo de pornografía y cómo te hace sentir. ¿Te sientes cómodo/a con tu consumo? ¿Te está afectando negativamente en otros aspectos de tu vida?</p>
            </div>
            </section>
            
            <section>
                <p>Es importante reconocer que muchas personas consumen pornografía en algún momento de sus vidas. El acceso a la pornografía ha aumentado significativamente en la era digital debido a Internet, lo que facilita su disponibilidad. La pornografía no proporciona una representación realista de las relaciones sexuales y puede distorsionar las expectativas sobre el sexo. A menudo muestra situaciones poco realistas, cuerpos ideales y comportamientos que no reflejan las relaciones sexuales reales ni la comunicación saludable entre parejas.</p>
                <p>Si tienes hijos o adolescentes en casa, utiliza herramientas de filtrado y restricciones parentales para evitar que accedan accidentalmente a contenido pornográfico en línea.</p>
                <div class="pageSection2">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/x4TjmaEpR6g?si=1ryFzxH2MtVBi2M9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/B52pjMd__18?si=QiVRi4rfMzpxBEB-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <h1>Educación Sexual Basada en la Realidad:</h1>
                
                <div class="blog3">
                    <img class="blog3_img" src="../Deseo/img/sexualidad-en-adolescentes-compressor.jpg" alt="placer">
                    <p> Observa cómo el consumo de pornografía puede estar afectando tu vida cotidiana, relaciones y bienestar emocional. Si notas efectos negativos, como disminución del interés en las relaciones reales o dificultades en el rendimiento sexual, considera reducir o detener el consumo.</p>
                    <p>Aprovecha el tiempo que solías dedicar a la pornografía en actividades más productivas y enriquecedoras. Esto puede incluir el ejercicio, la lectura, la creación de pasatiempos o la mejora de tus habilidades personales.</p>
                   
                </div>
                
            
              
                
                
            </section>
        </main>