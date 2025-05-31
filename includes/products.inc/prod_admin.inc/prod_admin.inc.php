<?php 
require_once 'dbh.inc.php';
require_once 'prod_admin_model.inc.php';
require_once 'prod_admin_model.inc.php';


$result = get_all_products($pdo);


require_once '../../config_session.inc.php';

