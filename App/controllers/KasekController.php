<?php

use App\Core\Controller;

class KasekController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['kencana_usersession']))
            header('location:'.BASEURL.'auth');
    }
    
    public function index()
    {
        $this->view('kasek/index',[],'admin');
    }
}
