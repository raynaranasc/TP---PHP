<?php
//Requisição do arquivo de configuração "config.php".
 
require_once './config.php';
 
/*Estrutura Condicional que verifica se os campos foram recebidos do formulário HTML abaixo.
 
Depois executa o comando SQL 'INSERT INTO' para inserir um novo usuário no sistema.
 
*/
 
if (isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['curso'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $curso = $_POST['curso'];
 
    $gestor = new PDO("mysql:host=". HOSTNAME. ";". "dbname=". DATABASE. "; charset=utf8", USERNAME, PASSWORD);
    $sql = "INSERT INTO usuario (nome, sobrenome, curso) VALUES (:nome, :sobrenome, :curso)";
    $stmt = $gestor->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':sobrenome', $sobrenome);
    $stmt->bindParam(':curso', $curso);
    $stmt->execute();
 
    //Execução de chamada do endereço "index.php".
    header('Location: index.php');
    exit;
}
 
// O código HTML abaixo mostra ao usuário o formulário a ser preenchido para a inserção no banco de dados.
 
?>
 
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Criar Aluno</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
       
    </div>
</body>
</html>