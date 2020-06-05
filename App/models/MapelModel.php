<?php
use App\Core\Controller;

class MapelModel extends Controller
{
    public function create()
    {
        $result = Database::table('mapel')->get();
        return $result;
    }

    public function show()
    {

    }
}
