<?php


include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

$view = new ProductView();


//Caso ja não tenha pego os produtos e ja não tenha sido retornado um erro, tenta conseguir a lista de todos os produtos
if (!isset($_SESSION["products"])  && !isset($_GET["error"])) {
    header("Location: includes/prod_list.inc.php");
}

?>


<html lang="en">

<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="shortcut icon" type="imagex/png" href="logodopetshop.jpg">
    <title>Loja do Pet Shop</title>
</head>

<body>


    <header class="main-header">
        <div class="container">
            <img src="public/img/logo1.jpg" class="logo"><a href="index.html"></a>
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


    <form action="includes/prod_list.inc.php" method="GET">
        <input type="text" name="search" placeholder="Buscar produto">
        <input type="submit" value="Buscar">
    </form>


    <main class="product-grid-container">
        <section class="product-grid">
            <?php
            $view->list_products();
            $view->check_errors();
            ?>
        </section>
    </main>




    <footer>
        <div class="container">
            <p>&copy; 2025 Pet Shop Feliz. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>


</html>