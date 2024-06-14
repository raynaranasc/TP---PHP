<?php
// configuração da conexão com o banco de dados 
require_once './config.php';

// Inicialização da classe de gerenciamento do banco de dados
$dbManager = new DatabaseManager(HOSTNAME, DATABASE, USERNAME, PASSWORD);//intanciação de objetos

// Verifica se há um parâmetro 'action' na URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Inicializa a variável $alunos
$alunos = [];

// Classe abstrata Manager
abstract class Manager
{
    protected $connection;

    // Método construtor para inicializar a conexão com o banco de dados
    public function __construct($hostname, $database, $username, $password) //Função com passagem de parametro
    {
        $dsn = "mysql:host=$hostname;dbname=$database;charset=utf8";
        $this->connection = new PDO($dsn, $username, $password);
    }
}
//uso de Herança da classe Manager na DatabaseManager
// Classe DatabaseManager que estende Manager
class DatabaseManager extends Manager
{
    // Método para buscar todos os usuários
    public function getAllUsers()
    {
        $sql = "SELECT * FROM usuario"; //String
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar usuários com base no curso
    public function getUsersByCourse($course)
    {
        $sql = "SELECT * FROM usuario WHERE curso = :course";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':course', $course, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obter todos os cursos
    public function getAllCourses()
    {
        $sql = "SELECT DISTINCT curso FROM usuario";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Método para obter as notas de um usuário específico
    public function getUserGrades($userId)
    {
        $sql = "SELECT nota1, nota2, trabalho FROM usuario WHERE id = :userId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Realiza diferentes ações com base no valor do parâmetro 'action'
switch ($action) {
    case 'list':
        // Obtém todos os usuários
        $alunos = $dbManager->getAllUsers();
        break;
    case 'curso':
        // Obtém usuários com base no curso
        if ($_GET['curso'] !== "Todos os Cursos") {
            if (isset($_GET['curso'])) {
                $curso = $_GET['curso'];
                $alunos = $dbManager->getUsersByCourse($curso);
            }
        } else {
            $alunos = $dbManager->getAllUsers();
        }
        break;
    default:
        // Ação padrão: lista todos os usuários
        $alunos = $dbManager->getAllUsers();
        break;
}

// Obtém todos os cursos disponíveis
$cursos = $dbManager->getAllCourses();

// O código HTML abaixo mostra ao usuário as informações dos estudantes.
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2> Alunos</h2>

        <!-- Formulário para selecionar o curso -->
        <form method="GET" action="index.php">
            <div class="mb-3">
                <label for="curso" class="form-label">Filtrar por Curso:</label>
                <select class="form-select" id="curso" name="curso">
                    <option value="Todos os Cursos">Todos os Cursos</option>
                    <?php 
                        // Uso do loop for
                        for ($i = 0; $i < count($cursos); $i++) { 
                    ?>
                        <option value="<?= $cursos[$i] ?>"><?= $cursos[$i] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <input type="hidden" name="action" value="curso">
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Curso</th>
                    <th>Média</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php 
                    // Uso do loop while
                    $count = 0;
                    while ($count < count($alunos)) { 
                ?>
                    <tr>
                        <td><?= $alunos[$count]['id'] ?></td>
                        <td><?= $alunos[$count]['nome'] ?></td>
                        <td><?= $alunos[$count]['sobrenome'] ?></td>
                        <td><?= $alunos[$count]['curso'] ?></td>
                        <td>
                            <?php
                            $notas = $dbManager->getUserGrades($alunos[$count]['id']);
                            if ($notas) {
                                $media = ($notas['nota1'] + $notas['nota2'] + $notas['trabalho']) / 3;
                            } else {
                                $media = 0;
                            }
                            echo number_format($media, 2);
                            ?>
                        </td>
                        <td>
                            <a href="edit_student.php?id=<?= $alunos[$count]['id'] ?>" class="btn btn-primary">Editar</a>
                            <a href="delete_student.php?id=<?= $alunos[$count]['id'] ?>" class="btn btn-danger">Excluir</a>
                            <a href="notas.php?id=<?= $alunos[$count]['id'] ?>" class="btn btn-success">Lançar Notas</a>
                        </td>
                    </tr>
                <?php 
                    // Uso de incremento
                    $count++;
                    } 
                ?>
            </tbody>
        </table>
        <a href="create_student.php" class="btn btn-success">Criar Novo Aluno</a>
    </div>
</body>

</html>
