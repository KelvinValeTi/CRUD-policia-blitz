<?php

    $servidor="localhost";
    $usuario = "root";
    $senha = "";
    $banco ="cadastro_efetivo";

    //conexão pdo
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

?>
    
