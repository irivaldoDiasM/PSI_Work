<?php
include('conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $username = $_POST['c_username'];
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $num_rows = $stmt->rowCount();

        if ($num_rows > 0) {
            header("Location: part1hn.php?erro=1&msg=O nome de utilizador já está sendo utilizado.");
            exit();
        } else {
            // Gerar um salt seguro
            $randomBytes = random_bytes(32);
            $salt = bin2hex($randomBytes);

            // Hash da palavra-passe com o salt
            $hashedPassword = hash_hmac('sha512', $password, $salt);

            // Inserir o utilizador na base de dados
            $stmt = $conn->prepare("INSERT INTO users (username, password, salt) VALUES (:username, :password, :salt)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':salt', $salt);
            
            if ($stmt->execute()) {
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
