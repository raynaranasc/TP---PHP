<?php
 
//Requisição do arquivo de configuração "config.php".
 
require_once './config.php';
 
$gestor = new PDO("mysql:host=". HOSTNAME. ";". "dbname=". DATABASE. "; charset=utf8", USERNAME, PASSWORD);
 
//Recebimento de valor através do método GET, e inserção do valor na variável '$id'.
 
$id = $_GET['id'];
 
//Utilização do comando SQL 'DELETE' para deletar um registro no banco de dados de acordo com a variável '$id'.
 
$sql = "DELETE FROM usuario WHERE id = :id";
    $stmt = $gestor->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
   
    //Execução de chamada do endereço "index.php".
    header('Location: index.php');
    exit;
 
?>