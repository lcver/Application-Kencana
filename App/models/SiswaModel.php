<?php

use App\Core\Controller;

class SiswaModel extends Controller
{
    public function show($data, $request)
    {
        switch ($request) {
            case 'select_by_nis':
                $result = Database::table("siswa")
                                    ->where("nis",$data)
                                    ->get();
                break;
            case 'select_by_kelas':
                $result = Database::table("siswa")
                                    ->where("idKelas",$data)
                                    ->get();
                break;
            case 'select_by_joining_kelas':
                $result = Database::table("siswa")
                                    ->join("kelas")
                                    ->on("siswa.idKelas","kelas.id and idKelas=$data")
                                    ->fetch(["siswa.*","kelas.kelas"])
                                    ->get();
                break;
            case 'siswa_lembarjawaban_check':
                $result = Database::table("siswa_jawaban")
                                    ->where('idSoalFile',$data['idFile']." and idSiswa=".$data['idSiswa'])
                                    ->get();
                 break;
            case 'view_kunci_jawaban_guru':
                $result = Database::table("soal_file")
                                    ->join("soal_butir")
                                    ->on("soal_file.id","soal_butir.idFile")
                                    ->fetch(["soal_file.*","soal_butir.kunci"])
                                    ->get();
                break;
            default:
                $result = [];
                break;
        }
        return $result;
    }
    public function store($data,$request)
    {
        switch ($request) {
            case 'insert_siswa':
                $result = Database::table("siswa")->insert($data);
                break;
            case 'insert_jawaban_siswa':
                $result = Database::table("siswa_jawaban")->insert($data);
                break;
            default:
                # code...
                break;
        }
        return $result;
    }
}
