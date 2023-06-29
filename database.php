<?php

class Database
{
    private \PDO $connection;

    public function __construct(
        private readonly string $host,
        private readonly string $username,
        private readonly string $password,
        private readonly string $database
    ) {
        $this->connect();
    }

    private function connect(): void
    {
        try {
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->database;charset=utf8",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("DB connection failed: {$e->getMessage()}");
        }
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}
?>
