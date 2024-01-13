<?php
declare (strict_types=1);

use Orm\Entity\Entities\User;

include_once __DIR__ . '/vendor/autoload.php';

$db = new \PDO('mysql:host=db;dbname=orm', 'root', 'secret');
$user_data = $db->query(sprintf('SELECT * FROM %s WHERE id = 1', User::TABLE))->fetch(PDO::FETCH_ASSOC);

$user = new User();
$user_mapper = new \Orm\Entity\Mappers\UserMapper();
$user_mapper->populate($user_data, $user);

