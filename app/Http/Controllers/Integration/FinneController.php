<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;

class FinneController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        parent::__construct($request);
    }



}
