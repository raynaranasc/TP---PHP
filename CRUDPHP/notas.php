<?php 
// configuração da conexão com o banco de dados 
require_once './config.php';


// obtém o id via get e converte para inteiro, se não existir retorna o valor 0
$id = isset($_GET['id'])? intval($_GET['id']) : 0;
$media = 0; //inicializa a variavel $media com 0
 

//Ele inicia uma estrutura condicional IF, e seleciona do banco de dados atraves do comando SELECT
if ($id > 0) {
    $gestor = new PDO("mysql:host=". HOSTNAME. ";". "dbname=". DATABASE. "; charset=utf8", USERNAME, PASSWORD); //Conecta com o banco de dados 
    $sql = "SELECT * FROM usuario WHERE id = :id";
    $stmt = $gestor->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
}
 
 
// obtém as notas 
if (isset($_POST['nota1']) && isset($_POST['nota2']) && isset($_POST['trabalho'])) {
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $trabalho = $_POST['trabalho'];

//Soma da média
    $media = ($nota1 + $nota2 + $trabalho) / 3;
 
//executa o comando SQL "UPDATE" para alterar as informações informadas pelo usuário
    $gestor = new PDO("mysql:host=". HOSTNAME. ";". "dbname=". DATABASE. "; charset=utf8", USERNAME, PASSWORD);
    $sql = "UPDATE usuario SET nota1=:nota1, nota2=:nota2, trabalho=:trabalho, media=:media WHERE id=:id";
    $stmt = $gestor->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nota1', $nota1);
    $stmt->bindParam(':nota2', $nota2);
    $stmt->bindParam(':trabalho', $trabalho);
    $stmt->bindParam(':media', $media);
    $stmt->execute();
}

// O código HTML abaixo mostra ao usuário o formulário a ser preenchido para a atualização de notas.
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lançar Notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Lançar Notas</h2>
        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" value="<?= $aluno['nome']?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nota1" class="form-label">Prova 1</label>
                <input type="number" class="form-control" id="nota1" name="nota1" required>
            </div>
            <div class="mb-3">
                <label for="nota2" class="form-label">Prova 2</label>
                <input type="number" class="form-control" id="nota2" name="nota2" required>
            </0>
            <div class="mb-3">
                <label for="trabalho" class="form-label">Trabalho</label>
                <input type="number" class="form-control" id="trabalho" name="trabalho" required>
            </div>
            <div class="mb-3">
                <label for="media" class="form-label">Média</label>
                <input type="text" class="form-control" id="media" value="<?= number_format($media, 2)?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>