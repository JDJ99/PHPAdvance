<?php

require_once 'vendor/autoload.php';

use App\Config\DatabaseConfig;
use App\Database\Database;
use App\Repositories\Repository;

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
        echo '<div class="post">
                <h3>'.$post['title'].'</h3>
                <p>'.$post['content'].'</p>
                <p class="timestamp">Posted on '.$post['created_at'].'</p>
                <p>
                    <a href="update.php?id='.$post['id'].'">Edit</a> |
                    <a href="delete.php?id='.$post['id'].'" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</a>
                </p>
              </div>';
    }
} else {
    echo '<p>No blog posts found.</p>';
}
?>

<a href="create.php">Create New Post</a>
