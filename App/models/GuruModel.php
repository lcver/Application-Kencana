<?php

use App\Core\Controller;

class GuruModel extends Controller
{
    public function store($data)
    {
        $result = Database::table("guru")->insert($data);
    }
}
