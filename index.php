<?php
  
include_once("classes/Config_session.class.php");
$session = new Config_Session();
$session->init();

include("classes/user_auth/UserView.classes.php");
$view = new UserView();
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
        <div class="container">
            <img src="public/img/logodopetshop.jpg" class="logo"><a href="index.html"></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.html">Início</a></li>
                    <li><a href="produtos.html">Produtos</a></li>
                    <li><a href="informacao.html">Informacao</a></li>
                    <?php
                    $view->login_info();
                    ?>
                   
                </ul>
            </nav>
        </div>
    </header>


  
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