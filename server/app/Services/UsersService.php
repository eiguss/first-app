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
                'language_id' => 1,
                'role_id' => 1,
            ],
            [
                'id' => 2,
                'email' => 'administrator@test.com',
                'name' => 'Admin',
                'creation_date' => 1650058268,
                'active' => true,
                'language_id' => 2,
                'role_id' => 2,
            ],
            [
                'id' => 3,
                'email' => 'laura.atilarooms@hotmail.com',
                'name' => 'Laura Gimenez',
                'creation_date' => 1650058268,
                'active' => false,
                'language_id' => 2,
                'role_id' => 2,
            ]
        ];
    }
}