<?php

namespace App\Controllers;

use Scara\Http\Controller;

class HomeController extends Controller
{
    /**
     * The method loaded from the default home page.
     *
     * @return void
     */
    public function index()
    {
        $this->render('index');
    }
}
