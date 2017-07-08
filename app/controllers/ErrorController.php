<?php

namespace App\Controllers;

use Scara\Http\Controller;

class ErrorController extends Controller
{
    // Place methods here

    public function error404()
    {
        $this->render('errors.404');
    }

    public function error400()
    {
        $this->render('errors.400');
    }
}
