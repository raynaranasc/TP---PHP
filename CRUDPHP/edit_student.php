<?php
 
//Requisição do arquivo de configuração "config.php".
 
require_once './config.php';
 
//Atribuição da variável '$id' com a utilização de um operador ternário.
 
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
 
/*Estrutura condicional "IF" para verificar se o '$id' corresponde à uma entrada no banco de dados.
 
Após a verificação, executa o comando SQL "SELECT" para receber as informações do usuário.
 
*/
 
if ($id > 0) {
    $gestor = new PDO("mysql:host=". HOSTNAME. ";". "dbname=". DATABASE. "; charset=utf8", USERNAME, PASSWORD);
    $sql = "SELECT * FROM usuario WHERE id = :id";
    $stmt = $gestor->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
}
 
/*Estrutura Condicional que verifica se os campos foram recebidos do formulário HTML abaixo.
 
Após a verificação, executa o comando SQL "UPDATE" para alterar as informações informadas pelo usuário.
 
*/
 
if (isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['curso'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $curso = $_POST['curso'];
 
    $gestor = new PDO("mysql:host=". HOSTNAME. ";". "dbname=". DATABASE. "; charset=utf8", USERNAME, PASSWORD);
    $sql = "UPDATE usuario SET nome = :nome, sobrenome = :sobrenome, curso = :curso WHERE id = :id";
    $stmt = $gestor->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':sobrenome', $sobrenome);
    $stmt->bindParam(':curso', $curso);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
 
    //Execução de chamada do endereço "index.php"
    header('Location: index.php');
    exit;
 
    // O código HTML abaixo mostra ao usuário o formulário a ser preenchido para a inserção no banco de dados.
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Editar Aluno</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?=$aluno['nome']?>" required>
            </div>
            <div class="mb-3">
                <label for="sobrenome" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?=$aluno['sobrenome']?>" required>
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" value="<?=$aluno['curso']?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>