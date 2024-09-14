<?php
use config.php;

try {
    $stmt = $pdo->query("SELECT * FROM dipendenti ORDER BY id DESC");
    $dipendenti = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($dipendenti);
} catch (PDOException $e) {
    echo "Errore durante il recupero: " . $e->getMessage();
}