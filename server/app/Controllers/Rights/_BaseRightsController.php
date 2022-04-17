<?php
namespace App\Controllers\Rights;

use App\Services\RightsService;
use App\Validators\ParamsValidator;
use App\Controllers\_BaseController;

class _BaseRightsController extends _BaseController 
{
    protected $rightsService;
    
    public function __construct(RightsService $rightsService,ParamsValidator $paramsValidator)
    {
        $this->rightsService = $rightsService;
        parent::__construct($paramsValidator);
    }
}