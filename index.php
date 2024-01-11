<?php
declare (strict_types=1);

use Orm\Entity\Entities\User;

include_once __DIR__ . '/vendor/autoload.php';

//fake from db
$users = include_once './src/Data/users.php';

$user = new User();
$user_mapper = new \Orm\Entity\Mappers\UserMapper();
$user_mapper->populate($users[0], $user);
echo $user->assembleDisplayName();