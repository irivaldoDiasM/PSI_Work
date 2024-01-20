<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $username = pg_escape_string($conn, $_POST['c_username']);
    $password = $_POST["c_password"];
    $confirm_password = $_POST["c_c_password"];

    // Validar os campos
    if (empty($username) || empty($password) || empty($confirm_password)) {
        header("Location: part1hn.php?erro=1&msg=Todos os campos são obrigatórios.");
        exit();
    } elseif (strlen($username) < 4) {
        header("Location: part1hn.php?erro=1&msg=O nome de utilizador deve ter no mínimo 4 caracteres");
        exit();
    } elseif ($password != $confirm_password) {
        header("Location: part1hn.php?erro=1&msg=A palavra-passe não corresponde");
        exit();
    } elseif (strlen($password) < 8) {
        header("Location: part1hn.php?erro=1&msg=A palavra-passe deve ter no mínimo 8 caracteres.");
        exit();
    } elseif (!preg_match("/[0-9]/", $password)) {
        header("Location: part1hn.php?erro=1&msg=A palavra-passe deve conter pelo menos 1 número.");
        exit();
    } elseif (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        header("Location: part1hn.php?erro=1&msg=A palavra-passe deve conter pelo menos 1 caractere especial.");
        exit();
    } else {
        // Verificar se o nome de utilizador já está a ser utilizado
        $result = pg_query_params($conn, "SELECT * FROM users WHERE username = $1", array($username));
        $num_rows = pg_num_rows($result);

        if ($num_rows > 0) {
            pg_free_result($result);
            header("Location: part1hn.php?erro=1&msg=O nome de utilizador já está sendo utilizado.");
            exit();
        } else {
            pg_free_result($result);

            // Gerar um salt seguro
            $randomBytes = random_bytes(32);
            $salt = bin2hex($randomBytes);

            // Hash da palavra-passe com o salt
            $hashedPassword = hash_hmac('sha512', $password, $salt);

            // Inserir o utilizador na base de dados
            $result = pg_query_params($conn, "INSERT INTO users (username, password, salt) VALUES ($1, $2, $3)", array($username, $hashedPassword, $salt));

            if ($result) {
                pg_free_result($result);
                header("Location: part1hn.php?success=1");
                exit();
            } else {
                header("Location: part1hn.php?erro=1&msg=Erro ao inserir usuário na base de dados.");
                exit();
            }
        }
    }
} else {
    header("Location: part1hn.php");
    exit();
}
?>