<?php

namespace App\Repositories;

use App\Database\Database;

class Repository
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $this->database->getConnection()->query($sql);
        $posts = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = $row;
        }

        return $posts;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->execute([$id]);
        $post = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $post ? $post : null;
    }

    public function create(array $data): bool
    {
        $title = $data['title'];
        $content = $data['content'];

        $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
        $stmt = $this->database->getConnection()->prepare($sql);

        return $stmt->execute([$title, $content]);
    }

    public function update(int $id, array $data): bool
    {
        $title = $data['title'];
        $content = $data['content'];

        $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
        $stmt = $this->database->getConnection()->prepare($sql);

        return $stmt->execute([$title, $content, $id]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->database->getConnection()->prepare($sql);

        return $stmt->execute([$id]);
    }
}
