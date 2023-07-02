<?php

require_once 'vendor/autoload.php';

use App\Database\Database;
use App\Config\DatabaseConfig;
use App\Repositories\Repository;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $database = new Database(
        DatabaseConfig::HOST,
        DatabaseConfig::USERNAME,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DBNAME
    );
    $repository = new Repository($database);

    $post = $repository->findById($id);
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $data = [
        'title' => $title,
        'content' => $content
    ];

    $database = new Database(
        DatabaseConfig::HOST,
        DatabaseConfig::USERNAME,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DBNAME
    );
    $repository = new Repository($database);

    $repository->update($id, $data);

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
