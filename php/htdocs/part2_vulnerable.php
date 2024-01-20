<?php
session_start();

$db = pg_connect("host=db dbname=ss-db-a1 user=ss-db-a1 password=ss-db-a1");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST['v_text'];

    $query = "INSERT INTO messages (author, message) VALUES ($1, $2)";
    $result = pg_query_params($db, $query, array($_SESSION['username'], $text));

    if (!$result) {
        echo "Erro ao enviar o texto.";
        exit;
    }

    header("Location: /part2_vulnerable.php");
    exit;
}

$query = "SELECT * FROM messages";
$result = pg_query($db, $query);

if (!$result) {
    echo "Erro ao recuperar mensagens.";
    exit;
}

$messages = pg_fetch_all($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>SS PA2 - Part 1.2</title>
</head>
<body>
    <table style="width: 500px" border="1" cellpadding="1">
        <thead>
        <tr>
            <th><b>Output Box</b></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($messages) {
            foreach ($messages as $message) {
                echo "<tr><td>{$_SESSION['username']}: {$message['message']}</td></tr>";
            }
        }
        ?>
        </tbody>
    </table>
</body>
</html>
