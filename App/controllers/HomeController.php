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
            // echo "id FIle : ".$d['id'];
            // echo "id user : ".$_SESSION['kencana_usersession'];
            $checkNilai = $nilai->show($d['id'],"filter_nilai");
            if(is_null($checkNilai))
            {
                // var_dump($checkNilai);
                $idKelas = unserialize($d['idKelas']);
                $d['idKelas']=[];
                $state=false;
                for ($i=0; $i < count($idKelas) ; $i++) {
                    if($_SESSION['kencana_siswakelas']==$idKelas[$i])
                    // if(in_array($_SESSION['kencana_siswakelas'], $idKelas))
                    {
                        $kelasSoal = $kelas->show($idKelas[$i],'id');

                        $d['idKelas'][] = $kelasSoal;
                        $state = true;                    
                        // var_dump($idKelas);
                    }
                }
                if($state){
                    // echo "ada kelas";
                    /**
                     * 1 Aktif
                     * 2 Nonaktif
                     */
                    if($d['status']==1){
                        // echo "ada status";
                        $data['listSoal'][] = $d;
                    }
                    // echo "<br>";
                }   
            }
        }
        // var_dump($data['listSoal']);die();

        $this->view('home/index',$data);
    }
}
