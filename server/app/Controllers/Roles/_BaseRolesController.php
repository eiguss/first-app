<?php
namespace App\Controllers\Roles;

use App\Services\RolesService;
use App\Validators\ParamsValidator;
use App\Controllers\_BaseController;

class _BaseRolesController extends _BaseController 
{
    protected $rolesService;
    
    public function __construct(RolesService $rolesService,ParamsValidator $paramsValidator)
    {
        $this->rolesService = $rolesService;
        parent::__construct($paramsValidator);
    }
}