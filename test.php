<?php
    require "includes/config_session.inc.php";
    if(!isset($_SESSION["user_id"])){
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
    <h1>Informações secretas </h1>
</body>
</html>