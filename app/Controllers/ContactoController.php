<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ContactoController extends BaseController
{
    public function index()
    {
        return view('contacto/index');
    }
}
