<?php
require_once "includes/config_session.inc.php";
require_once "includes/user_auth.inc/signup.inc/signup_view.inc.php";
require_once "includes/user_auth.inc/login.inc/login_view.inc.php";


?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="public/css/style.css" />
    <title>Loja do Pet Shop</title>
</head>

<body>
    <header class="main-header">
            <?php
               check_login();
            ?>
        <div class="container">
            <img src="public/img/logodopetshop.jpg" class="logo"><a href="index.html"></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.html">Início</a></li>
                    <li><a href="produtos.html">Produtos</a></li>
                    <li><a href="informacao.html">Informacao</a></li>
                    <li><a href="cadastro.html">Cadastro</a></li>
                </ul>
            </nav>
        </div>
    </header>


<!--Seção de login-->
    <h2> Login </h2>
    <form action="includes/user_auth.inc/login.inc/login.inc.php" method="POST">
        <label for="username">Usuário</label>
        <input type="text" name="username">
        <br>
        <label for="username">Senha</label>
        <input type="text" name="pwd">
        <br>
        <input type="submit" value="Login">
        
    </form>

    <?php
    check_login_errors();
    ?>
    <h2> Sign Up</h2>
    <form action="includes/user_auth.inc/signup.inc/signup.inc.php" method="POST">
        <?php
        signup_inputs();
        ?>
        <input type="submit" value="Cadastrar">
    </form>


    <?php
    check_signup_errors();
    ?>
    
    <br>

    <form action="includes/user_auth.inc/logout.inc.php">
        <input type="submit" value="Logout">
    </form>

    <main>
        <section class="hero">
            <h2>Seu Pet, Nossa Paixão!</h2>
            <p>Os melhores cuidados e produtos para quem você mais ama.</p>

        </section>

        <section class="info-section">
            <h3>Por que escolher o Pet Shop ////?</h3>
            </div>
        </section>
    </main>
    Mz



    <footer>
        <div class="container">
            <p>&copy; 2025 Pet Shop Feliz. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>