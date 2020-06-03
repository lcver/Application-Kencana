<?php

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // echo "Home index";
        // echo BASEURL;
        $this->view('home/index');
    }
}
