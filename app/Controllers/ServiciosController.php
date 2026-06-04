<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ServiciosController extends BaseController
{
    public function index()
    {
        return view('servicios/index');
    }
}
