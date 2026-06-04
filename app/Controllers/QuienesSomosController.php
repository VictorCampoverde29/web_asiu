<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class QuienesSomosController extends BaseController
{
    public function index()
    {
        return view('quienes_somos/index');
    }
}
