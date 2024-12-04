<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];

    if ($id) {
        $sql = "UPDATE eventos SET titulo='$titulo', descricao='$descricao', data='$data' WHERE id=$id";
    } else {
        $sql = "INSERT INTO eventos (titulo, descricao, data) VALUES ('$titulo', '$descricao', '$data')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Evento salvo com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_POST['id'];
    $sql = "DELETE FROM eventos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Evento excluído com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>