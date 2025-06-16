<?php
include_once("classes/user_auth/UserView.classes.php");


class MainView{
   
    public function header(){
        $login_view = new UserView();
        echo '
            <header class="main-header">
                <div class="container">
                    <img src="public/img/logo1.jpg" class="logo"><a href="index.html"></a>
                    <nav class="main-nav">
                        <ul>
                            <li><a href="index.php">Início</a></li>
                            <li><a href="prod_list.php">Produtos</a></li>
                            <li><a href="informacao.html">Informacao</a></li>
                ';
                $login_view->login_info();            
         echo '         </ul>
                    </nav>
                </div>
            </header>';



    }


    public function footer(){
        echo '<footer>
        <div class="container">
            <p>&copy; 2025 Pet Shop Feliz. Todos os direitos reservados.</p>
        </div>
    </footer>';
    }



}?>