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
        $formattedUsers = [];
        foreach ($users as $user) {
            $formattedUsers[] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name'],
                'creation_date' => $user['creation_date'],
                'active' => $user['active'],
                'language_name' =>$user['language']['name'],
                'language_code' =>$user['language']['isoCode'],
                'role' => $user['role']['name'],
            ];
        }

        return $formattedUsers;
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
                'name' => 'Laure Gimenez',
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