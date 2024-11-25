<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário de Eventos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Calendário de Eventos</h1>
        <div class="form-container">
            <form action="add_event.php" method="POST">
                <label for="titulo">Título do Evento:</label>
                <input type="text" id="titulo" name="titulo" required>
                
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"></textarea>
                
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>
                
                <button type="submit">Adicionar Evento</button>
            </form>
            
        </div>
        <div class="calendar">
            <?php require '/php/calendar.php'; ?>
        </div>
    </div>
</body>
</html>
