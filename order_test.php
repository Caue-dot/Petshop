<?php
    include 'classes/Dbh.inc.php';
    include 'classes/Config_session.class.php';
    include 'classes/products/Order.classes.php';
    include 'classes/products/OrderContr.classes.php';

    $order_contr = new OrderContr(6);
    $order_contr->add_product(13);
    $order_contr->add_product(15);
    $order_contr->add_product(16);
    $order_contr->add_product(17);
    
    $order_contr->purchase_order();
?>