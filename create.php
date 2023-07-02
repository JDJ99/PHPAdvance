<?php

require_once 'vendor/autoload.php';

use App\Database\Database;
use App\Config\DatabaseConfig;
use App\Repositories\Repository;

if (isset($_POST['submit'])) {
    $database = new Database(
        DatabaseConfig::HOST,
        DatabaseConfig::USERNAME,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DBNAME
    );
    $repository = new Repository($database);

    $title = $_POST['title'];
    $content = $_POST['content'];

    $data = [
        'title' => $title,
        'content' => $content
    ];

    $repository->create($data);

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
