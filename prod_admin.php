<?php

    require_once 'includes/products.inc/prod_admin.inc/prod_admin.inc.php';
    require_once 'includes/products.inc/prod_admin.inc/prod_admin_view.inc.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
    show_products();
    check_is_empty();
    ?>

</body>
</html>