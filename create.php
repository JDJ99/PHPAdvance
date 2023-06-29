<?php
require_once 'config.php';
require_once 'Database.php';

if (isset($_POST['submit'])) {
    $database = new Database($host, $username, $password, $dbname);
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
