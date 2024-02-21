<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "admin", "web");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nueva_contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];
    $token = $_POST['token'];

    // Verificar que las contraseñas coincidan
    if ($nueva_contraseña == $confirmar_contraseña) {
        // Verificar que el token sea válido y no haya expirado
        $stmt = $conexion->prepare("SELECT id FROM usuario WHERE reset_token = ? AND token_expiration > NOW()");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            $usuario_id = $usuario['id'];

            // Aquí, implementa la lógica para actualizar la contraseña.
            // Asegúrate de hashear la nueva contraseña antes de almacenarla.
            $contraseña_hash = password_hash($nueva_contraseña, PASSWORD_DEFAULT);
            
            $sql = "UPDATE usuario SET contraseña = ?, reset_token = NULL, token_expiration = NULL WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $contraseña_hash, $usuario_id);
            $stmt->execute();

            if ($stmt->affected_rows === 1) {
                echo "Contraseña actualizada con éxito.";
                // Aquí puedes redirigir al usuario a la página de inicio de sesión o a otra página.
            } else {
                echo "Error al actualizar la contraseña.";
            }
        } else {
            echo "El token no es válido o ha expirado.";
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
