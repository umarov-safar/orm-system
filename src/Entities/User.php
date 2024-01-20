<?php

declare (strict_types=1);

namespace Orm\Entity\Entities;

use Orm\Entity\Data\GenderEnum;

class User
{
    public const TABLE = 'users';

    private int $id;
    private string $first_name;
    private string $last_name;
    private int $gender;


    public function getFullNameWithGender()
    {
        return sprintf('%s %s %s', $this->getGenderText(), $this->first_name, $this->last_name);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function getGenderText(): string
    {
        return GenderEnum::from($this->gender)->text();
    }

    public function setGender(int $gender): void
    {
        $this->gender = $gender;
    }

}
