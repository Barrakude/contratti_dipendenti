<?php
$host = 'localhost';  // o l'indirizzo del tuo database
$dbname = 'contratti';
$username = 'root';  // Cambia con il tuo utente MySQL
$password = 'root';  // Cambia con la tua password MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Errore nella connessione al database: " . $e->getMessage());
}

