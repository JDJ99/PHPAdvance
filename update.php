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

    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $post = $stmt->fetch(\PDO::FETCH_ASSOC);
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $database = new Database(
        DatabaseConfig::HOST,
        DatabaseConfig::USERNAME,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DBNAME
    );
    $pdo = $database->getConnection();

    $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $content, $id]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Post</title>
</head>
<body>
<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo $post['title']; ?>">
    <br>
    <label for="content">Content:</label>
    <textarea name="content" id="content"><?php echo $post['content']; ?></textarea>
    <br>
    <input type="submit" name="submit" value="Update">
</form>
</body>
</html>
