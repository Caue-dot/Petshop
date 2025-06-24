<?php

include_once 'classes/Config_session.class.php';
$session = new Config_Session();
$session->init();

include("classes/MainView.class.php");
$main_view = new MainView();

//Caso não tenha uma sessão e o nome de usuario não for admin volta pra pagina inicial
if (!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin") {
    header("Location: index.php");
}
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Cadastro de produto</title>
</head>

<body>
    <?php
    $main_view->header();
    ?>
    <br>
    <main>
        
        <div class='container'>
            <h1>Cadastro de Produtos</h1>
            <form action='includes/prod_cad.inc.php' method='POST' enctype='multipart/form-data'>
                <div class='form-group'>
                    <label for='productName'>Nome do Produto:</label>
                    <input type='text' id='productName' name='name' required>
                </div>
    
                <div class='form-group'>
                    <label for='description'>Descrição:</label>
                    <textarea id='description' name='description' rows='4'></textarea>
                </div>
    
                <div class='form-group'>
                    <label for='price'>Preço (R$):</label>
                    <input type='number' id='price' name='price' step='0.01' min='0' required>
                </div>
    
                <div class='form-group'>
                    <label for='quantity'>Quantidade:</label>
                    <input type='number' id='quantity' name='quantity' min='0' required>
                </div>
    
                <div class='form-group'>
                    <label for='tags'>Tags (separadas por vírgula):</label>
                    <input type='text' id='tags' name='tag' placeholder='Ex: Ração, Gato, Saude'>
                </div>
    
                <div class='form-group'>
                    <label for='productImage'>Imagem do Produto:</label>
                    <input type='file' id='file' name='img' accept='image/*'>
                    <img id='preview' style="width: 400px;"> 
                </div>
    
    
                <button type='submit'>Cadastrar Produto</button>
            </form>
        </div>
    </main>
    <?php
    $main_view->footer();
    ?>
    <script src="public/js/img_displayer.js"></script>
</body>

</html>