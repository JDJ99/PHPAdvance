<?php
//
//require_once 'vendor/autoload.php';
//
//use App\Database\Database;
//use App\Config\DatabaseConfig;
//use App\Repositories\Repository;
//
//$database = new Database(
//    DatabaseConfig::HOST,
//    DatabaseConfig::USERNAME,
//    DatabaseConfig::PASSWORD,
//    DatabaseConfig::DBNAME
//);
//$repository = new Repository($database);
//
//$posts = $repository->findAll();
//
//if (!empty($posts)) {
//    foreach ($posts as $post) {
//        echo '<div class="post">
//                <h3>' . $post['title'] . '</h3>
//                <p>' . $post['content'] . '</p>
//                <p class="timestamp">Posted on ' . $post['created_at'] . '</p>
//              </div>';
//    }
//} else {
//    echo '<p>No blog posts found.</p>';
//}
//?>
