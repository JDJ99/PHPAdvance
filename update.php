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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Update Post</h1>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $post['title']; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control"><?php echo $post['content']; ?></textarea>
        </div>
        <input type="submit" name="submit" value="Update" class="btn btn-primary">
    </form>
</div>
</body>
</html>
