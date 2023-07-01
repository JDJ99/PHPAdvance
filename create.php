<?php

namespace App;

require_once 'vendor/autoload.php'; // Include the Composer autoloader

use App\Config\DatabaseConfig;
use App\Database\Database;


if (isset($_POST['submit'])) {
    $database = new Database(
        DatabaseConfig::HOST,
        DatabaseConfig::USERNAME,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DBNAME
    );
    $pdo = $database->getConnection();

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>
<form method="POST" action="create.php">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title">
    <br>
    <label for="content">Content:</label>
    <textarea name="content" id="content"></textarea>
    <br>
    <input type="submit" name="submit" value="Create">
</form>
</body>
</html>
