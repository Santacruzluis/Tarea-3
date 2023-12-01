<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<a href="cerrar.php" class="botones">Cerrar Sesion</a>
<h2>¿Qué desea realizar?</h2>

<div class="options">
    <h3>Ver los socios del sistema</h3>
    <form action="CRUD_ADMINI.php" method="post">
        <input type="text" value="0" name="Anular" hidden>
        <input type="text" value="1" name="campo" hidden>
        <input type="submit" value="Ver socios">
    </form>

    <h3>Ingresar socios al sistema</h3>
    <form action="CRUD_ADMINI.php" method="post">
        <input type="text" value="0" name="Anular" hidden>
        <input type="text" value="2" name="campo" hidden>
        <input type="submit" value="Ingresar Nuevo socio">
    </form>

    <h3>Modificar socio</h3>
    <form action="CRUD_ADMINI.php" method="post">
        <input type="text" value="0" name="Anular" hidden>
        <input type="text" value="3" name="campo" hidden>
        <input type="submit" value="Modificar Socio">
    </form>

    <h3>Eliminar socio del sistema</h3>
    <form action="CRUD_ADMINI.php" method="post">
        <input type="text" value="0" name="Anular" hidden>
        <input type="text" value="4" name="campo" hidden>
        <input type="submit" value="Eliminar socio">
    </form>
</div>
</body>
</html>