<?php
namespace App\Classes;

use App\Classes\SessionManager;

class CsrfTokenManager
{
    private $session;
    
    const CSRF_TOKEN_KEY = 'csrf_token';

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function generateCsrfToken()
    {
        $csrfToken = md5(uniqid(mt_rand(), true));
        $this->session->set(self::CSRF_TOKEN_KEY, $csrfToken);

        return $csrfToken;
    }

    public function getCsrfToken()
    {
        return $this->session->get(self::CSRF_TOKEN_KEY);
    }
}