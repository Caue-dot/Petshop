<?php
include_once 'classes/Config_session.class.php';
include_once 'classes/user_auth/UserView.classes.php';
$session = new Config_Session();
$session->init();

$view =  new UserView();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Cadastre-se </h3>
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
        <input type="submit" value="Cadastrar">
    </form>
    <?php
    $view->check_errors_signup();
    ?>
    <h3>Login </h3>
    <form action="includes/login.inc.php" method="POST">
        <label for="username">Usuário</label>
        <input type="text" name="username">
        <br>
        <label for="username">Senha</label>
        <input type="text" name="pwd">
        <br>
        <input type="submit" value="Login">
    </form>

    <?php
    $view->check_errors_login();
    echo "<br>";
    $view->login_info();

    ?>
</body>

</html>