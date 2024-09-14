<?php
use config.php;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $contratto = $_POST['contratto'];
    $data_assunzione = $_POST['data'];

    if (!empty($nome) && !empty($contratto) && !empty($data_assunzione)) {
        try {
            $sql = "INSERT INTO dipendenti (nome, contratto, data_assunzione) VALUES (:nome, :contratto, :data_assunzione)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':contratto' => $contratto,
                ':data_assunzione' => $data_assunzione
            ]);
            echo "Dipendente inserito con successo!";
        } catch (PDOException $e) {
            echo "Errore durante l'inserimento: " . $e->getMessage();
        }
    } else {
        echo "Tutti i campi sono obbligatori.";
    }
}

