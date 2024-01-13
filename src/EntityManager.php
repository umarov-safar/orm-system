<?php

namespace Orm\Entity;

use Orm\Entity\Repositories\UserRepository;

class EntityManager
{
    private string $host;
    private string $db;
    private string $user;
    private string $pwd;
    private \PDO $connection;
    private UserRepository $userRepository;

    public function __construct(string $host, string $db, string $user, string $pwd)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pwd = $pwd;

        $dns = 'mysql:host=' . $this->host . 'dbname=' . $db;
        $this->connection = new \PDO($dns, $user, $pwd);
    }

    public function query(string $stmt)
    {
        return $this->connection->query($stmt);
    }

    public function getUserRepository()
    {
        if (!isset($this->userRepository)) {
            $this->userRepository = new UserRepository($this);
        }

        return $this->userRepository;
    }
}
