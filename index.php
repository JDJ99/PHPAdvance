<?php

require_once 'vendor/autoload.php';

use App\Database\Database;
use App\Config\DatabaseConfig;

$database = new Database(
    DatabaseConfig::HOST,
    DatabaseConfig::USERNAME,
    DatabaseConfig::PASSWORD,
    DatabaseConfig::DBNAME
);
$pdo = $database->getConnection();

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="post">
                <h3>'.$row['title'].'</h3>
                <p>'.$row['content'].'</p>
                <p class="timestamp">Posted on '.$row['created_at'].'</p>
                <p>
                    <a href="update.php?id='.$row['id'].'">Edit</a> |
                    <a href="delete.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this post?\')">Delete</a>
                </p>
              </div>';
    }
} else {
    echo '<p>No blog posts found.</p>';
}
?>

<a href="create.php">Create New Post</a>
