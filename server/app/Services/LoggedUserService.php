<?php

namespace App\Services;

use App\Classes\SessionManager;

class LoggedUserService
{
    const SESSION_USER_DATA_KEY = 'user_data';

    private $userData;
    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
        $this->userData = $this->session->get(self::SESSION_USER_DATA_KEY);
    }

    public function getUserInfo()
    {
        return [
            'name' => $this->userData['name'],
            'email' => $this->userData['email'],
            'locale' => $this->userData['language']['isoCode'],
            'role' => $this->userData['role']['name'],
            'rights' => $this->getRights(),
        ];
    }

    public function getRights()
    {
        $rights=[];
        foreach ($this->userData['role']['rights'] as $right) {
            $rights[] = $right['name'];
        }

        return $rights;
    }

    public function login($email,$password)
    {
        if($email!=='root'||$password!=='root'){
            throw new \Exception('Error on login', 504);
        }
        $this->userData = $this->testUser(); //replace by a call to the service

        $this->saveData();

        return $this->userData;
    }
    
    public function getId()
    {
        return $this->userData ? $this->userData['id'] : false;
    }
    
    public function isLogged()
    {
        return !empty($this->userData['id']);
    }
    
    public function logout()
    {
        $this->session->newSession();
    }

    private function saveData()
    {
        $this->session->set(self::SESSION_USER_DATA_KEY, $this->userData);
    }

    private function testUser()
    {
        return [
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
        ];
    }
}