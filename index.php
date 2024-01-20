<?php
declare (strict_types=1);

use Orm\Entity\Entities\User;
use Orm\Entity\EntityManager;
use Orm\Entity\Repositories\UserRepository;

include_once __DIR__ . '/vendor/autoload.php';
define('CONFIG_PATH', __DIR__ . '/config/');


$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Entity manger for working with db
$entity_manager = EntityManager::getInstance();

$user = new User();
$user->setFirstName('John');
$user->setLastName('Doe');
$user->setGender(\Orm\Entity\Data\GenderEnum::MALE->value);
$entity_manager->saveUser($user);