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
}
