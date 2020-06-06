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
        $soal=$this->model("SoalModel");
        $kelas=$this->model("KelasModel");

        $listSoal = $soal->show($_SESSION['kencana_siswakelas'],"view_siswa");
        foreach ($listSoal as $d) {
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
            if($state)
                $data['listSoal'][] = $d;
        }
        // var_dump($listSoal);die();

        $this->view('home/index',$data);
    }
}
