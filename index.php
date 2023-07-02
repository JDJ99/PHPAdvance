<?php
require_once 'vendor/autoload.php';

use App\Config\DatabaseConfig;
use App\Database\Database;
use App\Repositories\Repository;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-left: 10px;
            margin-right: 10px;
        }

        .post {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Blog Posts</h1>
    <?php
    $database = new Database(
        DatabaseConfig::HOST,
        DatabaseConfig::USERNAME,
        DatabaseConfig::PASSWORD,
        DatabaseConfig::DBNAME
    );
    $repository = new Repository($database);
    $posts = $repository->findAll();

    if (!empty($posts)) {
        foreach ($posts as $post) {
            echo '
                <div class="post">
                    <h3>'.$post['title'].'</h3>
                    <p>'.$post['content'].'</p>
                    <p class="timestamp">Posted on '.$post['created_at'].'</p>
                    <p>
                        <a href="update.php?id='.$post['id'].'" class="btn btn-primary">Edit</a>
                        <a href="delete.php?id='.$post['id'].'" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</a>
                    </p>
                </div>';
        }
    } else {
        echo '<p>No blog posts found.</p>';
    }
    ?>
    <a href="create.php" class="btn btn-success">Create New Post</a>
</div>
</body>
</html>
