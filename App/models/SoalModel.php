<?php

use App\Core\Controller;

class SoalModel extends Controller
{
    public function show($data, $request)
    {
        switch ($request) {
            case 'view_guru':
                $result = Database::table("soal_file")
                                    ->join("mapel")
                                    ->on("soal_file.idMapel","mapel.id and idGuru = $data")
                                    ->fetch(["soal_file.*","mapel.mapel"])
                                    ->get();
                break;
            case 'view_siswa':
                $result = Database::table("soal_file")
                                    ->join("mapel")
                                    ->on("soal_file.idMapel","mapel.id and soal_file.status=1")
                                    ->fetch(["soal_file.*","mapel.mapel"])
                                    ->get();
                break;
            case 'select_by_id':
                $result = Database::table("soal_file")
                                    ->where("id",$data)
                                    ->get();
                break;
            case 'view_soal_guru':
                $result = Database::table("soal_butir")
                                    ->where("idFile",$data)
                                    ->get();
                break;

            case 'view_file_soal':
                $result = Database::table("soal_file")
                                    ->join("mapel")
                                    ->on("soal_file.idMapel","mapel.id and soal_file.id = $data")
                                    ->fetch(["soal_file.*","mapel.mapel"])
                                    ->get();
                break;
            case 'view_lembarsoal':
                $result = Database::table("soal_butir")
                                    ->join("soal_file")
                                    ->on("soal_butir.idFile","soal_file.id")
                                    ->join("mapel")
                                    ->on("soal_file.idMapel","mapel.id and soal_file.id = $data")
                                    ->fetch(["soal_butir.*","mapel.mapel"])
                                    ->get();
                break;
            default:
                $result=[];
                break;
        }

        return $result;
    }
    public function store($data, $request)
    {
        switch ($request) {
            case 'insert_soal_get_id':
                $result = Database::table("soal_file")->insert($data);
                if($result)
                {
                    $res = Database::table("soal_file")
                                        ->orderBy("id","desc limit 1")
                                        ->fetch(["id"])
                                        ->get();
                    return $res;
                }
                break;
            case 'soal_butir':
                $result = Database::table("soal_butir")->insert($data);

                break;
            default:
                $result = [];
                break;
        }
        return $result;
    }

    public function update($key,$value,$data)
    {
        $result = Database::table("soal_file")
                            ->where($key,$value)
                            ->update($data);
        return $result;
        
    }

    public function destroy($id)
    {
        // butir soal
        $result = Database::table("soal_butir")
                            ->where("idFile",$id)
                            ->delete();
        if($result)
            $result = Database::table("soal_file")->where("id",$id)->delete(); // file soal
        
            return $result;
    }
}
