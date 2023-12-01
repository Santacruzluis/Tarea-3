<?php
if ($_POST['Anular'] != 0) {
    if ($_POST) {

        if ($_POST['campo'] == 2) {
                // Lógica para crear un nuevo socio
                    // Obtener los datos del formulario
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];

                    // Obtener los socios existentes desde el archivo JSON
                    $socios = file_get_contents("archivo.json");
                    $socios = json_decode($socios, true);

                    // Obtener el último ID y generar el siguiente ID
                    $ultimoID = end($socios)['id']; // Obtener el último ID
                    $nuevoID = intval($ultimoID) + 1; // Generar el siguiente ID

                    // Nivel de Acceso predefinido (2 en este caso)
                    $nivelAcceso = "2";

                    // Contador de accesos inicializado en 0 para un nuevo socio
                    $accesos = 0;

                    // Crear el nuevo socio como un array asociativo
                    $nuevo_socio = [
                        "id" => strval($nuevoID), // Convertir el ID a cadena
                        "nombre" => $nombre,
                        "apellido" => $apellido,
                        "entradas" => $accesos,
                        "user" => $user,
                        "pass" => $pass,
                        "nivelAcceso" => $nivelAcceso
                    ];

                    // Agregar el nuevo socio al array de socios
                    $socios[] = $nuevo_socio;

                    // Codificar el array de socios de nuevo a JSON
                    $nuevo_contenido_json = json_encode($socios, JSON_PRETTY_PRINT);

                    // Guardar el nuevo contenido en el archivo JSON
                    file_put_contents("archivo.json", $nuevo_contenido_json);

                    echo "Nuevo socio agregado correctamente.";
                
            } else if ($_POST['campo'] == 3){
            
                    // Obtener los datos del formulario
                    $idSocio = $_POST['Socio']; // ID del socio seleccionado
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                
                    // Obtener los socios desde el archivo JSON
                    $socios = file_get_contents("archivo.json");
                    $socios = json_decode($socios, true);
                
                    if ($socios) {
                        foreach ($socios as &$socio) {
                            if ($socio['id'] == $idSocio) {
                                // Actualizar los datos del socio seleccionado
                                $socio['nombre'] = $nombre;
                                $socio['apellido'] = $apellido;
                                $socio['user'] = $user;
                                $socio['pass'] = $pass;
                
                                // Guardar los cambios en el archivo JSON
                                file_put_contents("archivo.json", json_encode($socios, JSON_PRETTY_PRINT));
                
                                echo "Socio modificado correctamente.";
                                break; // Terminar el bucle una vez que se ha modificado el socio
                            }
                        }
                    } else {
                        echo "No se encontraron datos de socios.";
                    }
                
    
                
            }else if ($_POST['campo'] == 4) {
                $idEliminar = $_POST['socioEliminar'];

                $socios = file_get_contents("archivo.json");
                $socios = json_decode($socios, true);
            
                $encontrado = false;
                foreach ($socios as $key => $socio) {
                    if ($socio['id'] == $idEliminar) {
                        unset($socios[$key]); // Elimina el socio del arreglo
                        $encontrado = true;
                        break;
                    }
                }
            
                if ($encontrado) {
                    $socios = array_values($socios); // Reindexa el arreglo
                    file_put_contents("archivo.json", json_encode($socios, JSON_PRETTY_PRINT));
                    echo "Socio eliminado correctamente.";
                } else {
                    echo "No se encontró un socio con ese ID.";
                }
            }
        
    
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>CRUD</title>
</head>
<body>

    <header>
    <?php
if (isset($_POST['campo'])) {
    if ($_POST['campo'] == 1) { ?>
        <h1>Listado de Socios</h1>
    <?php } elseif ($_POST['campo'] == 2) { ?>
        <h1>Registro de Nuevo Socio</h1>
    <?php } elseif ($_POST['campo'] == 3) { ?>
        <h1>Modificar Socio</h1>
    <?php } elseif ($_POST['campo'] == 4) { ?>
        <h1>Eliminar Socio</h1>
    <?php }
} 

?>
    </header>
    <main>
        <div class="options">
            <?php if ($_POST['campo'] == 1) { ?>
                <?php
$socios = file_get_contents("archivo.json");
$socios = json_decode($socios, true);
error_reporting(E_ERROR | E_PARSE);
if ($socios) {
    echo "<ul class='socios-list'>";
    foreach ($socios as $socio) {
        if ($socio['nivelAcceso'] != 1) {
            echo "<li class='socio-item'>
                    <strong>Nombre:</strong> " . $socio['nombre'] . " " . $socio['apellido'] . "<br>
                    <strong>Entradas:</strong> " . $socio['entradas'] . "<br>'";

            // Mostrar todas las fechas de acceso para usuarios con nivel de acceso 2
            if ($socio['nivelAcceso'] == 2) {
                echo "<strong>Todas las fechas de acceso:</strong><br>";
                foreach ($socio['fechaAcceso'] as $fecha) {
                    echo $fecha . "<br>";
                }
            }

            echo "</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p class='no-data'>No se encontraron datos de socios.</p>";
}
?>
<form action="filtrar.php" method="post">
<input type="submit" value="Filtrar" class="agregar-btn">
</form>
            <?php } elseif ($_POST['campo'] == 2) { ?>
                
                <form action="CRUD_ADMINI.php" method="post">
                    <input type="hidden" name="campo" value="2">
                    <input type="hidden" name="Anular" value="1">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br><br>

                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required><br><br>

                    <label for="user">Usuario:</label>
                    <input type="text" id="user" name="user" required><br><br>

                    <label for="pass">Contraseña:</label>
                    <input type="password" id="pass" name="pass" required><br><br>

                    <input type="submit" value="Agregar Socio" class="agregar-btn">
                </form>


            <?php } elseif ($_POST['campo'] == 3) { ?>
                <form action="CRUD_ADMINI.php" method="post">
                    <label for="Socio">Seleccione al socio que desea modificar:</label>
                    <select name="Socio" id="Socio" required>
                    <option value="">Seleccione un socio</option>
                        <?php
                        $socios = file_get_contents("archivo.json");
                        $socios = json_decode($socios, true);

                        if ($socios) {
                            foreach ($socios as $socio) {
                                if ($socio['nivelAcceso'] != 1) {
                                    echo "<option value=\"" . $socio['id'] . "\">" . $socio['nombre'] . " " . $socio['apellido'] . "</option>";
                                }
                            }
                        } else {
                            echo "<option value=\"\">No se encontraron datos de socios.</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <label for="nombre">Nuevo Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br><br>

                    <label for="apellido">Nuevo Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required><br><br>

                    <label for="user">Nuevo Usuario:</label>
                    <input type="text" id="user" name="user" required><br><br>

                    <label for="pass">Nueva Contraseña:</label>
                    <input type="password" id="pass" name="pass" required><br><br>

                    <input type="hidden" name="campo" value="3">
                    <input type="hidden" name="Anular" value="1">
                    <input type="submit" value="Modificar Socio" class="agregar-btn">
                </form>
                
                <?php } elseif ($_POST['campo'] == 4) { ?>

                    <form action="CRUD_ADMINI.php" method="post">
    <label for="socioEliminar">Seleccione al socio que desea eliminar:</label>
    <select name="socioEliminar" id="socioEliminar" required>

        <option value="">Seleccione un socio</option>
        <?php
        $socios = file_get_contents("archivo.json");
        $socios = json_decode($socios, true);

        if ($socios) {
            foreach ($socios as $socio) {
                if ($socio['nivelAcceso'] != 1) {
                    echo "<option value=\"" . $socio['id'] . "\">" . $socio['nombre'] . " " . $socio['apellido'] . "</option>";
                }
            }
        } else {
            echo "<option value=\"\">No se encontraron datos de socios.</option>";
        }
        ?>
    </select>
    <br><br>
    <input type="hidden" name="Anular" value="1">
    <input type="hidden" name="campo" value="4">
    <input type="submit" value="Eliminar Socio" class="eliminar-btn">
</form>

<?php } ?>
<a href="administrador.php" class="botones">volver</a>
        </div>
    </main>
           
</body>
</html>
