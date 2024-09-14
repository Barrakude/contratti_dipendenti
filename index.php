<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Dipendenti</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }

        .form-container {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .form-container label, .form-container input, .form-container select {
            display: block;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .search-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<h1>Gestione Dipendenti</h1>

<!-- Sezione di Inserimento -->
<div class="form-container">
    <h2>Inserisci Dipendente</h2>
    <label for="nome">Nome Dipendente:</label>
    <input type="text" id="nome" placeholder="Inserisci nome">

    <label for="contratto">Tipologia di Contratto:</label>
    <select id="contratto">
        <option value="tempo indeterminato">Tempo Indeterminato</option>
        <option value="tempo determinato">Tempo Determinato</option>
        <option value="part-time">Part-time</option>
        <option value="stage">Stage</option>
    </select>

    <label for="data">Data di Assunzione:</label>
    <input type="date" id="data">

    <button onclick="inserisciDipendente()">Aggiungi Dipendente</button>
</div>

<!-- Sezione di Ricerca -->
<div class="search-container">
    <h2>Cerca Dipendente</h2>
    <input type="text" id="search" placeholder="Cerca per nome" onkeyup="cercaDipendente()">
</div>

<!-- Tabella per Mostrare i Dipendenti -->
<table id="dipendenti-table">
    <thead>
        <tr>
            <th>Nome Dipendente</th>
            <th>Tipologia di Contratto</th>
            <th>Data di Assunzione</th>
        </tr>
    </thead>
    <tbody>
        <!-- I dipendenti verranno aggiunti qui -->
    </tbody>
</table>

<script>
    // Funzione per inserire un nuovo dipendente
    function inserisciDipendente() {
        const nome = document.getElementById('nome').value;
        const contratto = document.getElementById('contratto').value;
        const data = document.getElementById('data').value;

        if (nome && contratto && data) {
            const formData = new FormData();
            formData.append('nome', nome);
            formData.append('contratto', contratto);
            formData.append('data', data);

            fetch('inserisci_dipendente.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                caricaDipendenti();
            })
            .catch(error => console.error('Errore:', error));
        } else {
            alert("Per favore, inserisci tutte le informazioni.");
        }
    }

    // Funzione per caricare tutti i dipendenti
    function caricaDipendenti() {
        fetch('get_dipendenti.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#dipendenti-table tbody');
                tbody.innerHTML = '';

                data.forEach(dipendente => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${dipendente.nome}</td>
                        <td>${dipendente.contratto}</td>
                        <td>${dipendente.data_assunzione}</td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Errore:', error));
    }

    // Funzione per cercare un dipendente (locale)
    function cercaDipendente() {
        const query = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('#dipendenti-table tbody tr');

        rows.forEach(row => {
            const nome = row.children[0].textContent.toLowerCase();
            if (nome.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Carica i dipendenti all'avvio
    caricaDipendenti();
</script>

</body>
</html>
