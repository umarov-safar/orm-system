<?php

namespace Orm\Entity;

use Exception;
use Orm\Entity\Entities\User;
use Orm\Entity\Mappers\UserMapper;
use Orm\Entity\Repositories\UserRepository;
use PDO;

final class EntityManager
{
    private static ?EntityManager $instance = null;

    private UserRepository $user_repository;

    private PDO $connection;

    private function __construct()
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s", config('database.host'), config('database.database'));
        $this->connection = new PDO($dsn, config('database.user'), config('database.password'));
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {

    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }


    public function query(string $stmt): false|\PDOStatement
    {
        return $this->connection->query($stmt);
    }

    public function getUserRepository(): UserRepository
    {
        if (!isset($this->user_repository)) {
            $this->user_repository = new UserRepository($this);
        }

        return $this->user_repository;
    }

    public function saveUser(User $user)
    {
        $user_mapper = new UserMapper();
        $data = $user_mapper->extract($user);

        $user_id = call_user_func([$user, $user_mapper]);

        $columns_string = implode(', ', array_keys($data));
        $values_string = implode(', ', array_map(fn ($value) => $this->connection->quote($value), $data));

        return $this->query(sprintf('INSERT INTO %s (%s) VALUES(%s)', User::TABLE, $columns_string, $values_string));
    }
}
