<?php

namespace App;

require_once 'vendor/autoload.php'; // Include the Composer autoloader

use App\Config\DatabaseConfig;
use App\Database\Database;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $database = new Database(
        DatabaseConfig::HOST,
        DatabaseConfig::USERNAME,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DBNAME
    );
    $pdo = $database->getConnection();

    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: index.php');
    exit();
}
?>
