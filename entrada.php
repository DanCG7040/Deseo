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
                <h4>El bienestar sexual es un componente fundamental de la salud general de una persona. Implica sentirse bien con tu propio cuerpo, disfrutar de una vida sexual satisfactoria y tener relaciones sexuales seguras y consensuadas. Aquí hay algunas dimensiones clave del bienestar sexual:</h4>
                
                <div class="blog1">
                    <img src="../Deseo/img/001.jpg" alt="blog1">
                </div>
                
            </section>
            
            <section>
                <p>Autoaceptación: Aceptar tu propio cuerpo y sentirte cómodo con él es esencial para el bienestar sexual. Esto incluye la imagen corporal positiva, la autoestima y la confianza en uno mismo.</p>
                
                <div class="img2">
                    <img class="img2__flor"  src="../Deseo/img/flor.gif" alt="imagenflor">
                    <img class="img2__rata"  src="../Deseo/img/rata.gif" alt="imagerata">
                    <p> Tener una imagen corporal positiva significa que te sientes bien con la apariencia de tu cuerpo tal como es. Es comprender y apreciar las características únicas de tu cuerpo sin caer en la autocrítica constante o la insatisfacción. La imagen corporal positiva te permite disfrutar de la intimidad física sin preocupaciones excesivas sobre cómo te percibes a ti mismo o cómo te perciben los demás.</p>
                    <p>La confianza en uno mismo se relaciona con la seguridad en tus habilidades y decisiones sexuales. Tener confianza en tus habilidades puede llevarte a explorar y experimentar con mayor libertad en la intimidad. Además, la confianza en uno mismo te permite tomar la iniciativa para buscar y mantener relaciones sexuales seguras y consensuadas.</p>
                </div>
                <h1>Placer y Satisfacción</h1>
                
                <div class="blog3">
                    <img class="blog3_img" src="../Deseo/img/002.jpg" alt="placer">
                    <img class="blog3_img" src="../Deseo/img/plaisir.jpeg" alt="placer">
                    <img class="blog3_img" src="../Deseo/img/Cómo-generar-una-conexión-emocional-con-la-audiencia-.png" alt="placer">
                    <p>Variedad de Experiencias: El placer sexual puede manifestarse de muchas formas diferentes. Para algunas personas, el placer está vinculado al contacto físico, como el tacto, el beso y la estimulación genital. Para otras, el placer puede derivar de la intimidad emocional y la conexión con su pareja.</p>
                    <p>El placer sexual es una experiencia emocional y física positiva que se deriva de la actividad sexual. Es un componente fundamental de una vida sexual satisfactoria y puede variar significativamente de una persona a otra. Aquí hay algunos aspectos clave a considerar:</p>
                    <p>Conexión Emocional: La satisfacción sexual no se trata solo de la satisfacción física, sino también de la conexión emocional. Sentirte emocionalmente cerca de tu pareja puede aumentar la satisfacción general en las relaciones sexuales.</p>
                </div>
                
                <section class="youtube">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/uPi2zGrjr2w?si=-Jrn2zsW7YoecOGH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </section>
                <div class="blog4">
                    <p>Salud Física: El bienestar sexual también está relacionado con la salud física. Mantener
                        una buena salud general, incluido el control de las infecciones de transmisión sexual (I
                        TS) y el cuidado de la salud reproductiva, es fundamental.</p><img class="img4" src="/img/entrenar-entrenamiento.gif" alt="imagen gif">
                    </div>
              
                
                
            </section>
        </main>
        