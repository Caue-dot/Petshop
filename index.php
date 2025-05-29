<?php
    require_once "includes/config_session.inc.php";
    require_once "includes/signup_view.inc.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2> Login </h2>
      <form action="includes/login.inc.php">
        <label for="username">Usuário</label>
        <input type="text" name="username">
        <br>
        <label for="username">Senha</label>
        <input type="text" name="pwd">
        <br>
        <input type="submit" value= "Login">
    </form>
    <h2> Sign Up</h2>
    <form action="includes/signup.inc.php" method="POST">
        <label for="username">Usuário</label>
        <input type="text" name="username">
        <br>
        <label for="username">Senha</label>
        <input type="text" name="pwd">
        <br>
        <label for="email">Email</label> 
        <input type="text" name="email">
        <br>
        <input type="submit" value= "Cadastrar">
    </form>


    <?php
        check_signup_errors();
    ?>
</body>
</html>