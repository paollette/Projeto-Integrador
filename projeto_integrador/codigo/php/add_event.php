<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario";

// Conecta ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $data = $_POST["data"];

    $sql = "INSERT INTO eventos (titulo, descricao, data) VALUES ('$titulo', '$descricao', '$data')";

    if ($conn->query($sql) === TRUE) {
        echo "Evento adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: index.php"); // Redireciona de volta para a página principal
?>
