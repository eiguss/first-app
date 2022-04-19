<?php

namespace App\Services;

class UsersService
{
    public function getUsers()
    {
        // TODO service call
        return $this->formatData( $this->getUsersData() );
    }

    private function formatData($users)
    {
        return $users;
    }

    private function getUsersData()
    {
        return [
            [
                'id' => 1,
                'email' => 'root@test.com',
                'name' => 'Root Test',
                'creation_date' => 1650058268,
                'active' => true,
                'language' => [
                    'id' => 1,
                    'name' => 'english',
                    'isoCode' => 'en',
                ],
                'role' => [
                    'id' => 1,
                    'name' => 'Root',
                ],
            ],
            [
                'id' => 2,
                'email' => 'administrator@test.com',
                'name' => 'Admin',
                'creation_date' => 1650058268,
                'active' => true,
                'language' => [
                    'id' => 2,
                    'name' => 'spanish',
                    'isoCode' => 'es',
                ],
                'role' => [
                    'id' => 2,
                    'name' => 'Administrator',
                ],
            ],
            [
                'id' => 3,
                'email' => 'laura.atilarooms@hotmail.com',
                'name' => 'Laura Gimenez',
                'creation_date' => 1650058268,
                'active' => false,
                'language' => [
                    'id' => 2,
                    'name' => 'spanish',
                    'isoCode' => 'es',
                ],
                'role' => [
                    'id' => 2,
                    'name' => 'Administrator',
                ],
            ]
        ];
    }
}