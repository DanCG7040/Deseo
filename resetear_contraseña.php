<?php
// Este script se ejecuta cuando el usuario hace clic en el enlace de restablecimiento de contraseña.

// Inicia la sesión y/o asegúrate de que la configuración necesaria está en su lugar
session_start();

// Añade aquí la configuración de tu base de datos
$conexion = new mysqli("localhost", "root", "admin", "web");

// Comprueba si hay un parámetro 'token' en la URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepara una declaración SQL para verificar si hay un usuario con este token y si no ha expirado
    $stmt = $conexion->prepare("SELECT id FROM usuario WHERE reset_token = ? AND token_expiration > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Si se encuentra el token y no ha expirado, muestra el formulario para restablecer la contraseña
    if ($resultado->num_rows === 1) {
        // Asegúrate de almacenar el token en la sesión para usarlo más tarde
        $_SESSION['token'] = $token;
?>
       <!DOCTYPE html>
        <html>
        <head>
            <title>Restablecer Contraseña</title>
        </head>
        <body>
            <h2>Restablecer Contraseña</h2>
            <form action="procesar_reset.php" method="post">
                <label for="contraseña">Nueva Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
                <br>
                <label for="confirmar_contraseña">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>
                <br>
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <input type="submit" value="Restablecer Contraseña">
            </form>
        </body>
        </html>
<?php
    } else {
        echo "El enlace de restablecimiento no es válido o ha expirado.";
    }
} else {
    echo "No se ha proporcionado un token.";
}
?>
