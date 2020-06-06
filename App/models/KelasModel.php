<?php

use App\Core\Controller;

class KelasModel extends Controller
{
    public function create()
    {
        $result = Database::table('kelas')->get();
        return $result;
    }

    public function show($data, $request)
    {
        switch ($request) {
            case 'id':
                $result = Database::table('kelas')
                                    ->where('id',$data)
                                    ->get();
                break;
            
            default:
                $result = [];
                break;
        }
        return $result;
    }
}
