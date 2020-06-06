<?php
use App\Core\Controller;

class MapelModel extends Controller
{
    public function create()
    {
        $result = Database::table("mapel")->get();
        return $result;
    }

    public function show($data,$request)
    {
        switch ($request) {
            case 'muatan':
                $result = Database::table("mapel")
                                    ->where("muatan",$data)
                                    ->get();
                break;
            case 'id':
                $result = Database::table("mapel")
                                    ->where("id",$data)
                                    ->get();
                break;
            default:
                $result = [];
                break;
        }
        return $result;
    }
}
