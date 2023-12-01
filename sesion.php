<?php
$usuario = $_POST['user'];
$contraseña = $_POST['pass'];

// Obtener los datos del archivo JSON
$socios = file_get_contents("archivo.json");
$socios = json_decode($socios, true);

foreach ($socios as $key => $dato) {
    if ($usuario == $dato['user'] && $contraseña == $dato['pass'] && $dato['nivelAcceso'] == 1) {
        session_start();

        $_SESSION['user'] = $usuario;
        $_SESSION['pass'] = $contraseña;

        header("location: administrador.php");
        exit();
    } elseif ($usuario == $dato['user'] && $contraseña == $dato['pass'] && $dato['nivelAcceso'] == 2) {
        $socios[$key]['entradas']++;
        $socios[$key]['fechaAcceso'][] = date("d-m-Y H:i:s");

        // Actualizar el archivo JSON con los nuevos datos
        file_put_contents("archivo.json", json_encode($socios, JSON_PRETTY_PRINT));

        header("location: socio.php");
        exit();
    }
}

echo "Error de validación";
?>

