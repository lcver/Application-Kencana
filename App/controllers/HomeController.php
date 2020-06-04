<?php

use App\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['kencana_usersession']))
            header('location:'.BASEURL.'auth');
    }
    
    public function index()
    {
        // echo "Home index";
        // echo BASEURL;
        $this->view('home/index');
    }
}
