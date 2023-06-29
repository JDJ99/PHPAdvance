<?php
require_once 'config.php';
require_once 'Database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $database = new Database($host, $username, $password, $dbname);
    $pdo = $database->getConnection();

    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: index.php');
    exit();
}
?>
