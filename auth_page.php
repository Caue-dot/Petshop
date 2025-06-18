<?php
include_once 'classes/Config_session.class.php';
include_once 'classes/user_auth/UserView.classes.php';
$session = new Config_Session();
$session->init();

$view =  new UserView();

include("classes/MainView.class.php");
$main_view = new MainView();

if (isset($_SESSION["user_id"])) {
    header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticacao de Usuario - Pet Shop Feliz</title>
    <link rel="stylesheet" href="public/css/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>

<body>
    <?php $main_view->header() ?>
    <br><br><br>
    <h1>Identificação</h1>
    <div class="container-test">

        <main>
            <div class="auth-container">
                <section class="auth-form-section register-section">
                    <h2>Cadastre-se</h2>
                    <form action="includes/signup.inc.php" method="POST">
                        <div class="form-group">
                            <label for="register-username">Nome de Usuário:</label>
                            <br>
                            <input type="text" id="register-username" name="username">
                        </div>

                        <div class="form-group">
                            <label for="register-email">Email:</label>
                            <br>
                            <input type="email" id="register-email" name="email" >
                        </div>

                        <div class="form-group">
                            <label for="register-password">Senha:</label>
                            <br>
                            <input type="password" id="register-password" name="pwd" >
                        </div>
                        <br>
                        <?php
                        $view->check_errors_signup();
                        ?>
                        <div class="form-actions">
                            <button type="submit" class="auth-btn register-btn">Cadastre-se</button>
                        </div>
                    </form>
                </section>

                <div class="separator">OU</div>

                <section class="auth-form-section login-section">
                    <h2>Login</h2>
                    <form action="includes/login.inc.php" method="POST">
                        <div class="form-group">
                            <label for="login-username">Nome de Usuário:</label>
                            <br>
                            <input type="text" id="login-username" name="username" >
                        </div>

                        <div class="form-group">
                            <label for="login-password">Senha:</label>
                            <br>
                            <input type="password" id="login-password" name="pwd">
                        </div>
                        <br>
                        <?php
                        $view->check_errors_login();

                        ?>
                        <div class="form-actions">
                            <button type="submit" class="auth-btn login-btn">Entrar</button>
                        </div>
                    </form>

                </section>
            </div>
        </main>
    </div>
    <?php $main_view->footer() ?>
</body>

</html>