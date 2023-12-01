<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login del Club de Tenis</title>
  <!--<link rel="stylesheet" href="estilo.css">
  <link rel="stylesheet" href="fondo1.css">-->
  <link rel="icon" href="Image/icons8-servidor-individual-48.png" type="image/icon type">
  <link rel="stylesheet" href="style.css">
</head>

<body class="bg-login">
    <form action="sesion.php" method="POST" class= "form" >
        <h2 class="form__title">Inicia Sesión</h2>
        
          <div class="form__container" >
            <div class="form__group">
              <input required type="text" id="user" name="user" class="form__input" placeholder=" ">
              <label for="correo" class="form__label">Usuario:</label>
              <span class="form__line"></span>
            </div>
            <div class="form__group">
              <input required type="password" id="password" name="pass" class="form__input" placeholder=" ">
              <label for="password" class="form__label">Contraseña:</label>
              <span class="form__line"></span>
            </div>

            <input type="submit" class="form__submit" value="Ingresar">
        </div>
      </form>
      
</body>

</html>
  




