<?php

use App\Core\Controller;

class GuruModel extends Controller
{
    public function show($request)
    {
        $result = Database::table("guru")
                            ->where("nama_pengguna",$request)
                            ->get();
        return $result;
    }
    public function store($data)
    {
        $result = Database::table("guru")->insert($data);
        return $result;
    }
}
