<?php

namespace App;

require_once 'vendor/autoload.php'; // Include the Composer autoloader

use App\Config\DatabaseConfig;
use App\Database\Database;

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
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        echo '<div class="post">
                <h3>'.$row['title'].'</h3>
                <p>'.$row['content'].'</p>
                <p class="timestamp">Posted on '.$row['created_at'].'</p>
              </div>';
    }
} else {
    echo '<p>No blog posts found.</p>';
}
?>
