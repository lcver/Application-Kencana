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
                                    ->where('idFile',$data." and idSiswa='".$_SESSION['kencana_usersession']."'")
                                    ->get();
                break;
            case 'nilai_rekap':
                $result = Database::table('siswa_nilai')
                                    ->join('siswa')
                                    ->on('siswa_nilai.idSiswa','siswa.id and siswa.idKelas='.$data['kelas'])
                                    ->join('mapel')
                                    ->on('siswa_nilai.idMapel','mapel.id and siswa_nilai.idMapel='.$data['mapel'])
                                    ->get();
                break;
            case 'view_guru':
                $result = Database::table('siswa')
                                    ->join('kelas')
                                    ->on('siswa.idKelas','kelas.id and siswa.idKelas='.$data)
                                    ->join('siswa_nilai')
                                    ->on('siswa.id','siswa_nilai.idSiswa')
                                    ->join('mapel')
                                    ->on('siswa_nilai.idMapel','mapel.id')
                                    ->fetch(['siswa.*','siswa_nilai.nilai','mapel.mapel','kelas.kelas'])
                                    ->get();
                break;
            default:
                $result = [];
                break;
        }

        return $result;
    }
}
