<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calendário de Eventos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="calendar">
        <div class="header">
            <h1>Calendário de Eventos</h1>
            <button onclick="showEventForm()">Adicionar Evento</button>
        </div>
        <div id="calendar">
            <?php
            $conn = new mysqli("localhost", "root", "", "calendario");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query("SELECT * FROM eventos");
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event' data-id='{$row['id']}'>
                        <h3>{$row['titulo']}</h3>
                        <p>{$row['descricao']}</p>
                        <p>{$row['data']}</p>
                        <button onclick='editEvent({$row['id']})'>Editar</button>
                        <button onclick='deleteEvent({$row['id']})'>Excluir</button>
                      </div>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <div id="eventForm" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEventForm()">&times;</span>
            <form id="eventFormContent" method="post" action="eventos.php">
                <input type="hidden" id="eventId" name="id">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"></textarea>
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>
                <button type="submit">Salvar</button>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>