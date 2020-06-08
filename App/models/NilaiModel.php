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
    public function show($data,$request)
    {
        switch ($request) {
            case 'filter_nilai':
                $result = Database::table('siswa_nilai')
                                    ->where('idFile',$data.' and idSiswa='.$_SESSION['kencana_usersession'])
                                    ->get();
                break;
            default:
                $result = [];
                break;
        }

        return $result;
    }
}
