<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Helper;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected Request $request;


    public function __construct(Request $request)
    {
        $this->request = $request;

    }

}
