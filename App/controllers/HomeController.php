<?php

use App\Core\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['kencana_usersession']) || $_SESSION['kencana_rolesession']!=1)
            header('location:'.BASEURL.'auth');
    }
    
    public function index()
    {
        $data = null;
        $soal=$this->model("SoalModel");
        $kelas=$this->model("KelasModel");
        $nilai=$this->model("NilaiModel");

        $listSoal = $soal->show($_SESSION['kencana_siswakelas'],"view_siswa");
        $listSoal = Helper::null_checker($listSoal);
        // var_dump($listSoal);die();
        foreach ($listSoal as $d) {
            // $checkNilai = $nilai->show($d['id'],"filter_nilai");
            // if(is_null($checkNilai))
            // {
                $idKelas = unserialize($d['idKelas']);
                $d['idKelas']=[];
                $state=false;
                for ($i=0; $i < count($idKelas) ; $i++) {
                    if(in_array($_SESSION['kencana_siswakelas'], $idKelas))
                    {
                        $kelasSoal = $kelas->show($idKelas[$i],'id');

                        $d['idKelas'][] = $kelasSoal;
                        $state = true;                    
                        // var_dump($d['idKelas']);
                    }
                }
                if($state){
                    /**
                     * 1 Aktif
                     * 2 Nonaktif
                     */
                    if($d['status']==1){
                        $data['listSoal'][] = $d;
                    } else {
                        $data['listSoal'] = [];
                    }
                }   
            // }
        }
        // var_dump($listSoal);die();

        $this->view('home/index',$data);
    }
}
