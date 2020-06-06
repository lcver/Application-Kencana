<?php
use App\Core\Controller;

class MapelModel extends Controller
{
    public function create()
    {
        $result = Database::table("mapel")->get();
        return $result;
    }

    public function show($request)
    {
        $result = Database::table("mapel")
                                ->where("muatan",$request)
                                ->get();
        return $result;
    }
}
