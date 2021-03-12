<?php

namespace App\Services;

use App\Classes\SessionManager;

class UserService
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
        return $this->userData;
    }

    public function login($email,$password)
    {
        if($email!=='root'||$password!=='root'){
            throw new \Exception('Error on login', 504);
        }

        $this->userData = [
            'id' => 1,
            'email' => $email,
            'name' => 'Admin',
        ];
        $this->saveData();

        return $this->userData;
    }
    
    public function getId()
    {
        return $this->userData['id'];
    }
    
    public function logout()
    {
        $this->session->newSession();
    }

    private function saveData()
    {
        $this->session->set(self::SESSION_USER_DATA_KEY, $this->userData);
    }
}