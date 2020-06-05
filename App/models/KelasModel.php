<?php

use App\Core\Controller;

class KelasModel extends Controller
{
    public function create()
    {
        $result = Database::table('kelas')->get();
        return $result;
    }
}
