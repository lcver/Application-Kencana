<?php

use App\Core\Controller;

class NilaiModel extends Controller
{
    public function store($data)
    {
        $result = Database::table("siswa_nilai")
                            ->insert($data);
        return $result;
    }
    public function show()
    {
        
    }
}
