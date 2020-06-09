<?php
use App\Core\Controller;

class SoalController extends Controller
{
    public function index($id)
    {
        $id = $id[0];
        $soal = $this->model('SoalModel');


        $mapel = $soal->show($id,'view_file_soal');

        $data['soal'] = $soal->show($id,'view_lembarsoal');
        $data['mapel'] = $mapel['mapel'];
        // var_dump($data['mapel']);die();
        // var_dump($data);die();

        /**
             * set token for user
             * can't back on answersheet
             * 
             */
            $_SESSION['kencana_current_lembar_soal'] = $id;
        
        $this->view('soal/index',$data);

    }

    public function penilaian()
    {
        // var_dump($_POST);
        /**
         * check fix 
         * resend nilai
         * 
         */
        $idFile = $_POST['kencana_idFile'];

        $soal = $this->model("SoalModel");
        $siswa = $this->model("SiswaModel");
        $raw = [
            "idFile" => $idFile,
            "idSiswa" => $_SESSION['kencana_usersession']
        ];

        
        // $res = $siswa->show($raw,"siswa_lembarjawaban_check");
        // var_dump($res);die();
        
            // if($res!==NULL){
            //     header('location:'.BASEURL."soal/index/$idFile");
            //     return false;
            // }

        $res = $soal->show($idFile,"view_soal_guru");
        $count = count($res);
        for ($i=1; $i <= $count ; $i++) { 
            $data = [
                "idSiswa" => $_SESSION['kencana_usersession'],
                "jawaban" => $_POST['kencana_jawaban'.$i],
                "idSoalButir" => $_POST['kencana_idSoal'.$i],
                "idSoalFile" => $_POST['kencana_idFile']
            ];
            $result = $siswa->store($data,"insert_jawaban_siswa");
        }
        if($result){
            header('location:'.BASEURL.'soal/hasil');
            // session_unset($_SESSION['kencana_current_lembar_soal']);
            // header("location:".BASEURL."home");
        }

    }

    public function hasil()
    {
        /**
         * check token
         * 
         */
        if(!isset($_SESSION['kencana_current_lembar_soal'])) 
            header('location:'.BASEURL.'home');

            
        $siswa = $this->model("SiswaModel");
        $result = $siswa->show($_SESSION['kencana_current_lembar_soal'],'matching_answer');
        // var_dump($result);die();

        $totalSoal = 0;
        $benar = 0;
        foreach ($result as $d) { $totalSoal++;
            if($d['jawaban'] == $d['kunci'])
            {
                $benar++;
            }
            $idMapel = $d['idMapel'];

        }
        $nilai = floor($benar/$totalSoal*100);
        var_dump($nilai);
        $dataNilai = [
            'idSiswa'=>$_SESSION['kencana_usersession'],
            'idMapel'=> $idMapel,
            'idFile'=>$_SESSION['kencana_current_lembar_soal'],
            'nilai'=>$nilai
        ];
        $res = $this->model('NilaiModel')->store($dataNilai);
        if($res===TRUE)
        {
            /**
             * destroy token soal
             * 
             */
            unset($_SESSION['kencana_current_lembar_soal']);
            header('location:'.BASEURL.'home');
        }
        
    }

    public function view_hasil()
    {
        /**
         * get id paket soal by link
         */
        $id = $_GET['url'];
        $id = explode('/',$_GET['url']);
        $id = end($id);

        /**
         * 
         * fetch data soal dan jawaban
         */
        $ressoal = $this->model('ButirSoalModel')->show($id);
        
        if(!is_null($ressoal)){
            $key = array_keys($ressoal);

            $count = count($key);
            $num = NULL;

            for ($i=0; $i < $count ; $i++) { 
                if(is_numeric($key[$i])) $num = true;
            }

            // foreach ($resultkey as $key) {
            //     if(!is_numeric($key)) $num = false;
            // }
                if(!$num):
                    $data['soal'][] = $ressoal;
                else:
                    $data['soal'] = $ressoal;
                endif;
            // var_dump($data['soal']);
            // die();
        }else{
            $data['soal']=NULL;
        }

        /**
         * 
         * fetch data nilai siswa
         */
        $resnilai = $this->model('NilaiModel')->show($id);
        $data['nilai'] = $resnilai['nilai'];

        // if(!is_null($resnilai)){
        //     $key = array_keys($resnilai);

        //     $count = count($key);
        //     $num = NULL;

        //     for ($i=0; $i < $count ; $i++) { 
        //         if(is_numeric($key[$i])) $num = true;
        //     }

        //     // foreach ($resultkey as $key) {
        //     //     if(!is_numeric($key)) $num = false;
        //     // }
        //         if(!$num):
        //             $data['nilai'][] = $resnilai;
        //         else:
        //             $data['nilai'] = $resnilai;
        //         endif;
        //     // var_dump($data['nilai']);
        //     // die();
        // }else{
        //     $data['nilai']=NULL;
        // }

        $respaket = $this->model('PaketSoalModel')->show('soalsiswa',$id);
        $data['mapel'] = $respaket['pelajaran'];
        
        $this->view('soal/hasil',$data);

    }
}
