<?php

use App\Core\Controller;

class SoalModel extends Controller
{
    public function show($request)
    {
        $result = Database::table("soal_file")
                                ->join("mapel")
                                ->on("soal_file.idMapel","mapel.id and idGuru = $request")
                                ->fetch(["soal_file.*","mapel.mapel"])
                                ->get();

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
}