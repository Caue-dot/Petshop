<?php
require_once 'includes/dbh.inc.php';
require_once 'prod_admin_model.inc.php';
require_once 'prod_admin_controller.inc.php';

require_once 'includes/config_session.inc.php';
if (!isset($_SESSION["products"])) {


    try {
        if (isset($_GET["delete"])) {
            $id = $_GET["delete"];
            delete_product($pdo, $id);
        }

        $result = get_all_products($pdo);

        if (is_empty($result)) {
            $_SESSION["is_empty"] = "Não há produtos cadastrados";
        } else {
            $_SESSION["products"] = $result;
        }

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
