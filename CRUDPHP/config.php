<?php
    #Conectar Banco de Dados
    
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "crud_operation");

    $mysqli = new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE);

    if($mysqli->connect_errno) {
        echo "falha ao conectar:(" .$mysqli->connect_errno . ")" . $mysqli->connect_errno;
    }

    else {
        echo "Conectado ao Banco de Dados";
    }
?>