 <?php

    include_once("classes/Config_session.class.php");
    $session = new Config_Session();
    $session->init();

    include("classes/MainView.class.php");
    $main_view = new MainView();

    include_once 'classes/products/OrderView.classes.php';
    $view = new OrderView();
    if (!isset($_GET["id"]) || !isset($_SESSION["user_id"]) || !isset($_SESSION["order"])) {

        if(isset($_GET["buy"])){
            header("location: orders.php");  
            die();
        }
        if (!isset($_GET["error"])) {
            header("location: index.php");
            die();
        }

 
    }
    ?>



 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="public/css/style_purchase_page.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
     <title>Compra</title>
 </head>

 <body>
     <main>
         <div class="checkout-form">
             <section class="delivery-info">
                 <h2>1. Informações de Entrega</h2>
                 <div class="form-group">
                     <label for="cep">CEP:</label>
                     <input type="text" id="cep" name="cep" placeholder="Ex: 00000-000" pattern="\d{5}-\d{3}" maxlength="9" required>
                     <small>Formato: XXXXX-XXX</small>
                 </div>
             </section>

             <section class="personal-info">
                 <h2>2. Informações Pessoais</h2>
                 <div class="form-group">
                     <label for="nome-completo">Nome Completo:</label>
                     <input type="text" id="nome-completo" name="nomeCompleto" required>
                 </div>
                 <div class="form-group">
                     <label for="cpf">CPF:</label>
                     <input type="text" id="cpf" name="cpf" placeholder="Ex: 000.000.000-00" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" maxlength="14" required>
                     <small>Formato: XXX.XXX.XXX-XX</small>
                 </div>
                 <div class="form-group">
                     <label for="email">Email:</label>
                     <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" required>
                 </div>
                 <div class="form-group">
                     <label for="telefone">Telefone:</label>
                     <input type="tel" id="telefone" name="telefone" placeholder="Ex: (00) 90000-0000" pattern="\(\d{2}\) \d{4,5}-\d{4}" maxlength="15" required>
                     <small>Formato: (XX) XXXXX-XXXX ou (XX) XXXX-XXXX</small>
                 </div>
             </section>

             <section class="payment-info">
                 <h2>3. Informações de Pagamento (Cartão de Crédito)</h2>
                 <div class="form-group">
                     <label for="numero-cartao">Número do Cartão:</label>
                     <input type="text" id="numero-cartao" name="numeroCartao" placeholder="0000 0000 0000 0000" pattern="[0-9\s]{13,19}" maxlength="19" required>
                 </div>
                 <div class="form-row">
                     <div class="form-group expiry-date">
                         <label for="validade-cartao">Validade:</label>
                         <input type="text" id="validade-cartao" name="validadeCartao" placeholder="MM/AA" pattern="(0[1-9]|1[0-2])\/\d{2}" maxlength="5" required>
                         <small>Formato: MM/AA</small>
                     </div>
                     <div class="form-group cvv">
                         <label for="cvv">CVV:</label>
                         <input type="text" id="cvv" name="cvv" placeholder="XXX" pattern="\d{3,4}" maxlength="4" required>
                     </div>
                 </div>
                 <div class="form-group">
                     <label for="nome-titular">Nome do Titular do Cartão:</label>
                     <input type="text" id="nome-titular" name="nomeTitular" required>
                 </div>
             </section>

             <div class="checkout-actions">
                 <?php
                    if (!isset($_GET["error"])) {
                        echo "<a href='includes/purchase_page.inc.php?buy=true'> <button type='submit' class='finish-purchase-btn'>Finalizar Compra</button> </a> ";
                    } else {
                        $view->check_errors();
                    }

                    ?>
             </div>
         </div>
     </main>

 </body>

 </html>

 </header>