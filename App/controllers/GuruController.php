<?php

use App\Core\Controller;

class GuruController extends Controller
{
    public function index()
    {
        $this->view("guru/index",[],"admin");
    }
}
