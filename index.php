<?php
  
include_once("classes/Config_session.class.php");
$session = new Config_Session();
$session->init();

include("classes/user_auth/UserView.classes.php");
$view = new UserView();
?>

<html lang="pt-br">
<head>
		<meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="public/css/style.css"/>
		<link rel="shortcut icon" type="imagex/png" href="logodopetshop.jpg">
        <title>Inicio</title>

    </head>
<body>
		<header class="main-header">
        <div class="container">
            <img src="public/img/logo1.jpg" class="logo"><a href="index.html"></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="prod_list.php">Produtos</a></li>
                    <li><a href="informacao.html">Informacao</a></li>
                    <?php $view->login_info()?>
                </ul>
            </nav>
        </div>
    </header>
		
    <main>
        <section class="hero">
            <h2>Seu Pet, Nossa Paixão!</h2>
            <p>Os melhores cuidados e produtos para quem você mais ama.</p>           
        </section>                          
    </main>
<header>
        <h1>Bem-vindo ao Seu Pet Shop!</h1>
    </header>

    <main class="main-content-container">

        <section class="pet-selection-section">
            <div class="pet-card dog-card">
                <img src="public/img/logo cachorro.jpg" alt="Ícone de Cachorro">
                <h2>Cachorros</h2>
                <a href="#" class="btn-view-all">Ver todos</a>
            </div>

            <div class="pet-card cat-card">
                <img src="public/img/logogato1.jpg" alt="Ícone de Gato">
                <h2>Gatos</h2>
                <a href="#" class="btn-view-all">Ver todos</a>
            </div>
        </section>

        <section class="popular-categories-section">
            <h2>Categorias Populares para Cachorros</h2>
            <div class="categories-list">
                <a href="#" class="category-item">
                    <img src="public/img/ração logo.png" alt="Ícone Ração">
                    <span>Rações Secas</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/antipulgalogo.png" alt="Ícone Antipulgas">
                    <span>Antipulgas</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/brinquedo logo.png" alt="Ícone Brinquedos">
                    <span>Brinquedos</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/higienelogo.png" alt="Ícone Tapete">
                    <span>Higiene</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/logo medicamentos.png" alt="Ícone Medicamentos">
                    <span>Medicamentos</span>
                </a>
            </div>
        </section>

        <section class="popular-categories-section">
            <h2>Categorias Populares para Gatos</h2>
            <div class="categories-list">
                <a href="#" class="category-item">
                    <img src="public/img/raçãogatologo.png" alt="Ícone Ração">
                    <span>Rações Secas</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/areialogo.png" alt="Ícone Areia">
                    <span>Areias</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/arranhadorlogo.png" alt="Ícone Brinquedos">
                    <span>Arranhadores</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/logoprtiscos.png" alt="Ícone Petisco">
                    <span>Petiscos</span>
                </a>
                <a href="#" class="category-item">
                    <img src="public/img/saudelogo.png" alt="Ícone Saúde">
                    <span>Saúde</span>
                </a>
            </div>
        </section>  
    </main>







 
    <footer>
        <div class="container">
            <p>&copy; 2025 Pet Shop Feliz. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>