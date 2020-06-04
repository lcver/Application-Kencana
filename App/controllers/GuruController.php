<?php

use App\Core\Controller;

class GuruController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['kencana_usersession']) || $_SESSION['kencana_rolesession']!=2)
            header('location:'.BASEURL.'auth');
    }
    public function index()
    {
        $this->view("guru/index",[],"admin");
    }

    public function bank_soal()
    {
        $this->view("guru/bank_soal",[],"admin");
    }
}
