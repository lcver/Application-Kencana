<?php

use App\Core\Controller;

class SiswaModel extends Controller
{
    public function show($request)
    {
        $result = Database::table("siswa")
                            ->where("nis",$request)
                            ->get();
        return $result;
    }
    public function store($data)
    {
        $result = Database::table("siswa")->insert($data);
        return $result;
    }
}
