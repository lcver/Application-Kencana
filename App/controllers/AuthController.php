<?php

use App\Core\Controller;

class AuthController extends Controller
{
    public function index()
    {
        $this->view('auth/index',[],'single');
    }
}
