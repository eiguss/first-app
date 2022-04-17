<?php

namespace App\Services;

class RolesService
{
    public function getRoles()
    {
        // TODO service call
        return $this->formatData( $this->getRolesData() );
    }

    private function formatData($roles)
    {
        return $roles;
    }

    private function getRolesData()
    {
        return [
            [
                'id' => 1,
                'name' => 'Root',
                'description' => 'Role with all the rights',
                'rights' => [
                    [
                        'id' => 1,
                        'name' => 'users_management',
                    ],
                    [
                        'id' => 2,
                        'name' => 'rights_management',
                    ],
                    [
                        'id' => 3,
                        'name' => 'roles_management',
                    ],
                    [
                        'id' => 4,
                        'name' => 'rooms_management',
                    ],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Administrator',
                'description' => 'Role with all rights except manage roles and rights','rights' => [
                    [
                        'id' => 1,
                        'name' => 'users_management',
                    ],
                    [
                        'id' => 4,
                        'name' => 'rooms_management',
                    ],
                ]
            ],
            [
                'id' => 3,
                'name' => 'Sales',
                'description' => 'Role to manage rooms',
                'rights' => [
                    [
                        'id' => 4,
                        'name' => 'rooms_management',
                    ],
                ]
            ]
        ];
    }
}