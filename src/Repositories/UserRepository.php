<?php

declare (strict_types=1);

namespace Orm\Entity\Repositories;

use Orm\Entity\Entities\User;
use Orm\Entity\EntityManager;
use Orm\Entity\Mappers\UserMapper;

class UserRepository
{
    private EntityManager $entityManager;
    private UserMapper $userMapper;


    public function __construct(EntityManager $entityManager)
    {
        $this->userMapper = new UserMapper();
        $this->entityManager = $entityManager;
    }

    public function findById(int $id)
    {
        $user_data = $this->entityManager
            ->query(sprintf('SELECT * FROM %s WHERE id = %s', User::TABLE, $id))
            ->fetch();

        if ($user_data) {
            return $this->userMapper->populate($user_data, new User());
        }

        return null;
    }
}
