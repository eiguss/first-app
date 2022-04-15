<?php
namespace App\Controllers\Users;

use App\Services\UsersService;
use App\Validators\ParamsValidator;
use App\Controllers\_BaseController;

class _BaseUsersController extends _BaseController 
{
    protected $usersService;
    
    public function __construct(UsersService $usersService,ParamsValidator $paramsValidator)
    {
        $this->usersService = $usersService;
        parent::__construct($paramsValidator);
    }
}