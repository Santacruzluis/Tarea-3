<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="filtro.css">
    <link rel="stylesheet" href="estilos.css">
    <title>Filtrar</title>
</head>
<body>
    <?php
    $socios = file_get_contents("archivo.json");
    $socios = json_decode($socios, true);

    $formularioEnviado = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $formularioEnviado = true;
        error_reporting(E_ERROR | E_PARSE);
        $targetSocio = $_POST['socios'];
        $targetFecha = $_POST['fecha'];
    }

    if ($socios) {
        ?><br><br>
        <form method="post" action="filtrar.php">
            <label for="socios">Selecciona un socio:</label>
            <select name="socios" id="socios">
            <option value="">Seleccione un socio</option>
                <?php
                foreach ($socios as $socio) {
                    if ($socio['nivelAcceso'] != 1) {
                        echo "<option value='" . $socio['id'] . "'>" . $socio['nombre'] . " " . $socio['apellido'] . "</option>";
                    }
                }
                ?>
            </select>
            <br><br>

            <input type="submit" value="Filtrar">
        </form>
        <br><br>
        <?php
       if ($formularioEnviado) {
        echo "<h2>Resultados del filtro:</h2>";
        echo "<ul class='socios-list'>";
    
        if (isset($_POST['filtrarPorFecha'])) {
            foreach ($socios as $socio) {
                if ($socio['nivelAcceso'] != 1 && isset($targetFecha) && in_array($targetFecha, $socio['fechaAcceso'])) {
                    echo "<li class='socio-item'>
                            <strong>Nombre:</strong> " . $socio['nombre'] . " " . $socio['apellido'] . "<br>
                            <strong>Entradas:</strong> " . $socio['entradas'] . "<br>
                            <strong>Fechas de acceso:</strong><br>";
                    foreach ($socio['fechaAcceso'] as $fecha) {
                        echo $fecha . "<br>";
                    }
                    echo "</li>";
                }
            }
        } else {
            foreach ($socios as $socio) {
                if ($socio['nivelAcceso'] != 1 && isset($targetSocio) && $socio['id'] == $targetSocio) {
                    echo "<li class='socio-item'>
                            <strong>Nombre:</strong> " . $socio['nombre'] . " " . $socio['apellido'] . "<br>
                            <strong>Entradas:</strong> " . $socio['entradas'] . "<br>
                            <strong>Fechas de acceso:</strong><br>";
                    foreach ($socio['fechaAcceso'] as $fecha) {
                        echo $fecha . "<br>";
                    }
                    echo "</li>";
                }
            }
        }
        echo "</ul>";
    }
    } else {
        echo "<p class='no-data'>No se encontraron datos de socios.</p>";
    }
    ?>
        <div class="options">
        <form action="administrador.php" method="post">
            <input type="submit" value="Volver" class="volver-btn">
        </form>
    </div>
</body>
</html>
