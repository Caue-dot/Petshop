<?php
    
    include_once 'classes/Config_session.class.php';
    $session = new Config_Session();
    $session->init();
    
    if(!isset($_SESSION["user_id"]) || $_SESSION["user_username"] != "admin"){
        header("Location: index.php");
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastro de produto </h1>

    <form id="cad" action="includes/prod_cad.inc.php" method="post" enctype="multipart/form-data"> 
        <h3>Nome: </h3>
        <input type="text" name="name">
        <br>
        <h3>Descrição: </h3>
        <textarea form ="cad" name="description"></textarea>
        <br>
        <h3>Preço: </h3>
        <input type="number" name="price">
        <br>
        <h3>Quantidade do estoque</h3>
        <input type="number" name="quantity">
        <br>
        <h3>Selecione uma imagem:</h3> 
        <input type="file" name="img">
        <?php
        
        ?>
        <br><br>
        <input type="submit" value = "Submit" name="submit">

    </form> 

    
</body>
</html>