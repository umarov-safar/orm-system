<?php
declare (strict_types=1);

use Orm\Entity\Entities\User;
use Orm\Entity\EntityManager;
use Orm\Entity\Helpers\Config;
use Orm\Entity\Repositories\UserRepository;

include_once __DIR__ . '/vendor/autoload.php';

define('CONFIG_PATH', __DIR__ . '/config/');

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Entity manger for working with db
$entity_manager = new EntityManager(
    Config::get('database.host'),
    Config::get('database.database'),
    Config::get('database.user'),
    Config::get('database.password')
);


$user = new User();
$user_reopistory = new UserRepository($entity_manager);
$user = $user_reopistory->findById(1);
echo $user->getFirstName();
