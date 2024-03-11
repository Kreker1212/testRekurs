<?php

/**
 * @var PDO $pdo
 */
require_once __DIR__ . '/connect.php';

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS url_shortenings (
        id INT PRIMARY KEY AUTO_INCREMENT,
        url VARCHAR(255) NOT NULL,
        short_url VARCHAR(50) UNIQUE NOT NULL
    )";

    $pdo->exec($sql);

    echo 'Таблица успешно создана!';
    echo '<br>';
    echo '<a href="/testLink/index.php"><button>Сократить ссылку</button></a>';
} catch (PDOException $e) {
    echo "Ошибка при создании таблицы: " . $e->getMessage();
}