<?php
session_start();

$db = pg_connect("host=db dbname=ss-db-a1 user=ss-db-a1 password=ss-db-a1");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['v_username'];
    $password = $_POST['v_password'];
    $remember = $_POST['v_remember'];
    
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = pg_query($db, $query);

    if (!$result) {
        echo "Erro na consulta ao banco de dados.";
        exit;
    }

    $row = pg_fetch_assoc($result);

    if (!$row) {
        echo "Falha na autenticação. Usuário ou senha incorretos.";
    } else {
        echo "Bem-vindo, $username!";
    }

} else {
    echo "Método inválido.";
}
?>
