<?php

declare (strict_types=1);

namespace Orm\Entity\Mappers;

use Orm\Entity\Contracts\Mapperable;
use Orm\Entity\Entities\User;

class UserMapper implements Mapperable
{
    private array $mapping = [
        'id' => 'id',
        'first_name' => 'first_name',
        'last_name' => 'last_name',
        'gender' => 'gender',
    ];

    public function extract(User $user): array
    {
        $data = [];

        foreach ($this->mapping as $key_obj => $key_column) {
            if ($key_column !== 'id') {
                $data[$key_column] = call_user_func([$user, $this->makeMethod('get', $key_obj)]);
            }
        }

        return $data;
    }

    public function populate(array $data, User $user)
    {
        $mappingFlipped = array_flip($this->mapping);

        foreach ($data as $key => $value) {
            if (isset($mappingFlipped[$key])) {
                call_user_func_array([$user, $this->makeMethod('set', $mappingFlipped[$key])], [$value]);
            }
        }

        return $user;
    }

    protected function makeMethod(string $prefix, string $name)
    {
        if (str_contains($name, '_')) {
            $names = explode('_', $name);

            return $prefix . join('', array_map(fn ($name) => ucfirst($name), $names));
        }

        return $prefix . ucfirst($name);
    }
}
