# Gerenciamento de Alunos

Este projeto é um sistema de gerenciamento de alunos desenvolvido em PHP, que permite visualizar, filtrar e gerenciar informações de alunos e suas respectivas notas. A aplicação utiliza um banco de dados MySQL para armazenar as informações dos alunos.

## Funcionalidades

- Listar todos os alunos.
- Filtrar alunos por curso.
- Visualizar a média das notas dos alunos.
- Editar informações dos alunos.
- Excluir alunos.
- Lançar notas dos alunos.

## Requisitos

- XAMPP (inclui PHP 7.4 ou superior e MySQL)
- Navegador web

## Configuração

1. Clone o repositório para o seu ambiente local:

    ```bash
    git clone [https://github.com/seuusuario/CRUDPHP.git]
    ```

2. Mova o projeto para o diretório `htdocs` do XAMPP:

    ```bash
    mv gerenciamento-de-alunos /caminho/para/xampp/htdocs/
    ```

3. Configure as informações de conexão com o banco de dados no arquivo `config.php`:

    ```php
    define('HOSTNAME', 'localhost');
    define('DATABASE', 'nome_do_banco_de_dados');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    ```

4. Inicie o servidor Apache e o MySQL através do painel de controle do XAMPP.

5. Crie o banco de dados e importe o arquivo SQL fornecido no repositório:

    1. Abra o phpMyAdmin no navegador: `http://localhost/phpmyadmin`
    2. Crie um novo banco de dados.
    3. Selecione o banco de dados criado e vá para a aba "Importar".
    4. Importe o arquivo SQL localizado em `/caminho/para/xampp/htdocs/crud_operation.sql`.

6. Inicie o servidor web e acesse o projeto através do navegador:

    ```
    http://localhost/CRUDPHP
    ```

## Estrutura do Projeto

- `index.php`: Página principal que lista e filtra os alunos.
- `config.php`: Arquivo de configuração contendo as credenciais do banco de dados.
- `DatabaseManager.php`: Classe responsável por gerenciar a interação com o banco de dados.
- `create_student.php`: Página para criação de um novo aluno.
- `edit_student.php`: Página para edição de informações de um aluno existente.
- `delete_student.php`: Página para exclusão de um aluno.
- `notas.php`: Página para lançamento de notas de um aluno.

## Uso

### Listar Todos os Alunos

Ao acessar a página principal `index.php`, todos os alunos cadastrados serão listados em uma tabela. 

### Filtrar Alunos por Curso

Use o formulário de seleção de curso no topo da página para filtrar os alunos de acordo com o curso selecionado.

### Visualizar Média das Notas

A média das notas de cada aluno será calculada automaticamente e exibida na tabela.

### Editar Informações dos Alunos

Clique no botão "Editar" ao lado do aluno desejado para editar suas informações.

### Excluir Alunos

Clique no botão "Excluir" ao lado do aluno desejado para excluir suas informações.

### Lançar Notas

Clique no botão "Lançar Notas" ao lado do aluno desejado para lançar ou editar suas notas.

