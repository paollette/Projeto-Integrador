document.getElementById('eventFormContent').addEventListener('submit', function(event) {
    event.preventDefault();
    const id = document.getElementById('eventId').value;
    const titulo = document.getElementById('titulo').value;
    const descricao = document.getElementById('descricao').value;
    const data = document.getElementById('data').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'eventos.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Evento salvo com sucesso!');
            closeEventForm();
        } else {
            alert('Erro ao salvar o evento.');
        }
    };
    xhr.send(`id=${id}&titulo=${titulo}&descricao=${descricao}&data=${data}`);
});

function showEventForm() {
    document.getElementById('eventForm').style.display = 'block';
}

function closeEventForm() {
    document.getElementById('eventForm').style.display = 'none';
}
