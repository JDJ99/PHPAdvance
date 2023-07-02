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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Create Post</h1>
    <form method="POST" action="create.php">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div>
        <input type="submit" name="submit" value="Create" class="btn btn-primary">
    </form>
</div>
</body>
</html>
