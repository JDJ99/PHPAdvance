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

    $repository->delete($id);

    header('Location: index.php');
    exit();
}
?>
