<?php
require_once 'config.php';
require_once 'Database.php';

$database = new Database($host, $username, $password, $dbname);
$pdo = $database->getConnection();

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
