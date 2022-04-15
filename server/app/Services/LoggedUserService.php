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
            'locale' => $this->userData['locale'],
        ];
    }

    public function login($email,$password)
    {
        if($email!=='root'||$password!=='root'){
            throw new \Exception('Error on login', 504);
        }

        $this->userData = [
            'id' => 1,
            'email' => 'Admin@test.com',
            'name' => 'Admin',
            'locale' => 'en',
        ];
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
}