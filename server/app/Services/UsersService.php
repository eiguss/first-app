<?php

namespace App\Services;

class UsersService
{
    public function getUsers()
    {
        // TODO service call
        return $this->formatUsersData( $this->getUsersData() );
    }

    private function formatUsersData($users)
    {
        $formattedUsers = [];
        foreach ($users as $key => $user) {
            $formattedUsers[] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name'],
                'creation_date' => $user['creation_date'],
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
            '1' => [
                'id' => 1,
                'email' => 'root@test.com',
                'name' => 'Root Test',
                'creation_date' => 1650058268,
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
            '2' => [
                'id' => 2,
                'email' => 'administrator@test.com',
                'name' => 'Admin',
                'creation_date' => 1650058268,
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