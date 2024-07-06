<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{

    public PDO $connection;
    private PDOStatement $stmt;

    public function __construct(string $driver, array $config, string $username, string $password)
    {

        $config = http_build_query(data: $config, arg_separator: ';');
        $dsn = "{$driver}:{$config}";
        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            die("Unable to connect to database");
        }
    }

    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);

        $this->stmt->execute($params);

        return $this;
    }

    public function count(): mixed
    {
        return $this->stmt->fetchColumn();
    }

    public function find(): mixed
    {
        return $this->stmt->fetch();
    }

    public function id(): string|false
    {
        return $this->connection->lastInsertId();
    }

    public function findAll(): array|false
    {
        return $this->stmt->fetchAll();
    }
}
