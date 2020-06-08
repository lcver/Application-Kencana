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
            case 'matching_jawaban_kunci':
                // $result = Database::table('soal_butir')
                //                     ->join('siswa_jawaban')
                //                     ->on('soal_butir.idFile','siswa_jawaban.idSoalFile')
                $result = Database::table('soal_file')
                        ->join('soal_butir')
                        ->on('soal_file.id','soal_butir.idFile and soal_file.idGuru='.$data)
                        ->join('siswa_jawaban')
                        ->on('soal_file.id','siswa_jawaban.idSoalFile and siswa_jawaban.idSoalButir = soal_butir.id')
                        ->fetch([
                            'soal_file.idMapel',
                            'soal_file.idGuru',
                            'soal_butir.kunci',
                            'siswa_jawaban.jawaban',
                            'siswa_jawaban.idSiswa'])
                        ->get();
                break;
            case 'matching_answer':
                $result =  Database::table('soal_file')
                                ->join('soal_butir')
                                ->on('soal_file.id','soal_butir.idFile')
                                ->join('siswa_jawaban')
                                ->on('soal_file.id ='.$data.' and soal_butir.id','siswa_jawaban.idSoalButir and siswa_jawaban.idSiswa='.$_SESSION['kencana_usersession'])
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
