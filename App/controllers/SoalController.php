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

        
        $res = $siswa->show($raw,"siswa_lembarjawaban_check");
        // var_dump($res);die();
        
            if($res!==NULL){
                header('location:'.BASEURL."home");
                return false;
            }

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
            session_unset($_SESSION['kencana_current_lembar_soal']);
            header("location:".BASEURL."home");
        }

    }

    public function hasil($idPaket)
    {
        /**
         * get id by link
         */
        $id = $idPaket;

        /**
         * check token
         * 
         */
        if(!isset($_SESSION['elenka_token_soal'])) 
            header('location:'.BASEURL);

        $result = $this->model('ButirSoalModel')->show($id);
        // var_dump($result[0]);die();

        $totalSoal = 0;
        $benar = 0;
        foreach ($result as $d) { $totalSoal++;
            if($d['jawaban'] == $d['kunciJawaban'])
            {
                $benar++;
            }
            // $idMapel = $d['idMatapelajaran'];
            // $idSoal = $d['id'];
        }
        $nilai = $benar/$totalSoal*100;
        // var_dump($nilai);

        $dataNilai = [
            'idPaketSoal'=>$id,
            'idSiswa'    =>$_SESSION['elenka_usersession'],
            'nilai'      =>$nilai
        ];
        
        
        /**
         * 
         * store data into
         * tampil nilai
         */
        $res = $this->model('PaketSoalModel')->show('soalsiswa',$id);
        switch ($res['id']) {
            case '1':
                $keyNilai = 'ppkn';
                break;
            case '2':
                $keyNilai = 'bindo';
                break;
            case '3':
                $keyNilai = 'matematika';
                break;
            case '4':
                $keyNilai = 'sbdp';
                break;
            case '5':
                $keyNilai = 'pjok';
                break;
            case '6':
                $keyNilai = 'ipa';
                break;
            case '7':
                $keyNilai = 'ips';
                break;
        }
        $data = [
            'idSiswa'   => $_SESSION['elenka_usersession'],
            'idKelas'   => $_SESSION['elenka_userkelas'],
            'idBagian'  => $_SESSION['elenka_userbagian'],
            $keyNilai   => $nilai
        ];
        
        $checkTampilNilai = $this->model('TampilNilaiModel')->show($data['idSiswa']);

        if($checkTampilNilai===NULL){
            $res = $this->model('TampilNilaiModel')->store($data);
        }else{
            $res = $this->model('TampilNilaiModel')->update($checkTampilNilai['id'],$data);
        }

        if($res===TRUE){

            $res = $this->model('NilaiModel')->store($dataNilai);
            if($res===TRUE)
            {
                header('location:'.BASEURL.'soal/view_hasil/'.$id);
            }
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
         * destroy token soal
         * 
         */
        unset($_SESSION['elenka_token_soal']);


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
