<?php
include("classes/MainView.class.php");
$main_view = new MainView();
include_once("classes/Config_session.class.php");
$session = new Config_Session();
$session->init();

?>
 <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administracao - Pet Shop</title>
    <link rel="stylesheet" href="public/css/style_admin_panel.css">
</head>
<body>
    

<?php $main_view->header() ?>
<br><br><br><br>
<h1>Painel Administrativo</h1>
    

    <main>
        <section class="admin-dashboard">
            <h2>Bem-vindo ao Painel de Controle</h2>
            <p>Selecione uma opção abaixo para gerenciar os produtos do Pet Shop.</p>

            <div class="dashboard-actions">
                <a  href="prod_list_admin.php" class="dashboard-btn view-products">
                    Listagem de Produtos
                    <span>Gerenciar produtos existentes</span>
                </a>
                <a href="prod_cad.php" class="dashboard-btn add-product">
                    Cadastrar Novo Produto
                    <span>Adicionar um novo item ao estoque</span>
                </a>
            </div>
        </section>
    </main>
    
<?php $main_view->footer() ?>
</body>
</html>
    
    
    
    