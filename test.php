<?php 

include_once 'classes/Config_session.class.php';
include_once 'classes/products/ProductView.classes.php';
$session = new Config_Session();
$session->init();

echo "ID da sessão: " . session_id();
print_r($_COOKIE);