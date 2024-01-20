<?php

// Inicia a sessão para gerenciar variáveis de sessão
session_start();

// Conecta ao banco de dados PostgreSQL
$db = pg_connect("host=db dbname=ss-db-a1 user=ss-db-a1 password=ss-db-a1");

// Verifica se a conexão com o banco de dados foi bem-sucedida
if (!$db) {
    echo "Erro ao conectar ao banco de dados.";
    exit;
}

// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $username = $_POST['c_username'];
    $password = $_POST['c_password'];

    // Prepara uma consulta SQL usando instruções preparadas
    $query = "SELECT * FROM users WHERE username = $1";
    $result = pg_prepare($db, "fetch_user_query", $query);

    // Verifica se a preparação da consulta foi bem-sucedida
    if (!$result) {
        echo "Erro na preparação da consulta.";
        exit;
    }

    // Executa a consulta usando instruções preparadas e obtém os dados do usuário
    $result = pg_execute($db, "fetch_user_query", array($username));
    $user = pg_fetch_assoc($result);

    // Verifica se o usuário foi encontrado no banco de dados
    if (!$user) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Obtém a senha hash armazenada no banco de dados
    $hashedPassword = $user['password'];

    // Exibe informações de depuração
    echo "Senha digitada: " . $password . "<br>";
    echo "Salt do usuário: " . $user['salt'] . "<br>";
    echo "Senha armazenada no banco de dados: " . $hashedPassword . "<br>";

    // Compara as senhas de forma segura, sem sensibilidade a maiúsculas e minúsculas
    if (strcasecmp($password, $hashedPassword) == 0) {
        echo "Autenticação bem-sucedida.<br>";
    } else {
        echo "Senha incorreta.<br>";
    }
} else {
    // Se o método da requisição não for POST, exibe uma mensagem de erro
    echo "Método inválido.";
}

?>
