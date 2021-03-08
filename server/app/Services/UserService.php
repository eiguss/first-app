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
    
    public function getId()
    {
        return $this->userData['id'];
    }
}