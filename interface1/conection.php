

<?php
$host = "db"; // 
$port ="5432";
$dbname = "ss-db-a1";// 
$user = "ss-db-a1";
$password = "ss-db-a1";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "";
} catch (PDOException $e) {
   // echo "Falha na conexão: " . $e->getMessage();
}

?>

