<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "admin", "web");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar el token en la base de datos
    $stmt = $conexion->prepare("SELECT id FROM usuario WHERE reset_token = ? AND token_expiration > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
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