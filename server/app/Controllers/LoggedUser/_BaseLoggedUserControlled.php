<?php
namespace App\Controllers\LoggedUser;

use App\Services\LoggedUserService;
use App\Controllers\_BaseController;
use App\Classes\CsrfTokenManager;
use App\Validators\ParamsValidator;

class _BaseLoggedUserControlled extends _BaseController 
{

    protected $loggedUserService;
    protected $csrfTokenManager;
    
    public function __construct(LoggedUserService $loggedUserService, CsrfTokenManager $csrfTokenManager, ParamsValidator $paramsValidator)
    {
        $this->loggedUserService = $loggedUserService;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->paramsValidator = $paramsValidator;
    }
}