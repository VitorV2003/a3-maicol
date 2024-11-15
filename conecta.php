<?php
// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=mercado;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>