<?php

use App\Core\Controller;

class GuruModel extends Controller
{
    public function show($data,$request)
    {
        switch ($request) {
            case 'nama_pengguna':
                $result = Database::table("guru")
                                    ->where("nama_pengguna",$data)
                                    ->get();
                break;
            case 'id':
                $result = Database::table("guru")
                                    ->where("id",$data)
                                    ->get();
                break;
            default:
                $result = [];
                break;
        }        
        return $result;
    }
    public function store($data)
    {
        $result = Database::table("guru")->insert($data);
        return $result;
    }
}
