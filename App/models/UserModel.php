<?php

use App\Core\Controller;

class UserModel extends Controller
{
    public function authentication(Array $data)
    {
        $res = Database::table('user')
                            ->raw("username='".$data['username']."' and password='".$data['password']."'")
                            ->get();
        return $res;
    }

    public function store($data)
    {
        $result = Database::table("user")->insert($data);
        return $result;
    }

    public function show($data, $request)
    {
        switch ($request) {
            case 'value':
                # code...
                break;
            
            default:
                # code...
                break;
        }
    }
}
