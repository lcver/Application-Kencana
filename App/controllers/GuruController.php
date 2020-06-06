<?php

use App\Core\Controller;

class GuruController extends Controller
{
    public function __construct()
    {
        if(!isset($_SESSION['kencana_usersession']) || $_SESSION['kencana_rolesession']!=2)
            header('location:'.BASEURL.'auth');
    }

    public function index()
    {
        $this->view("guru/index",[],"admin");
    }

    public function bank_soal()
    {
        $guru = $this->model("GuruModel")->show($_SESSION['kencana_usersession'], 'id');
        $mapel = $this->model("MapelModel");
        $kelas = $this->model("KelasModel");
        $soal = $this->model("SoalModel");

        // Data mapel
        $mapelGuru = unserialize($guru['matapelajaran']);
        
        for ($i=0; $i < count($mapelGuru); $i++) { 
            $res = $mapel->show($mapelGuru[$i],'id');
            $data['mapel'][] = $res;
        }
        // var_dump($data['mapel']);die();

        // Data kelas
        $kelasGuru = unserialize($guru['kelas']);

        for ($i=0; $i < count($kelasGuru); $i++) { 
            $res = $kelas->show($kelasGuru[$i],'id');
            $data['kelas'][] = $res;
        }

        // List Soal
        $res = $soal->show($_SESSION['kencana_usersession']);
        $res = Helper::null_checker($res);
        if(!is_null($res))
        {
            foreach ($res as $res) {
                $kelasFile = unserialize($res['idKelas']);
                $res['idKelas']=[];
                for ($i=0; $i < count($kelasFile); $i++) { 
                    $soalKelas = $kelas->show($kelasFile[$i],'id');
                    $res['idKelas'][] = $soalKelas;
                    // var_dump($soalKelas);
                }
                $data['listSoal'][] = $res;
            }
        } else {
            $data['listSoal'] = NULL;
        }
        // var_dump($data['listSoal']);die();
        $this->view("guru/bank_soal",$data,"admin");
    }

    public function generate_soal()
    {
        $temp_file = $_FILES['kencana_soalfile']['tmp_name'];
        $type_file = $_FILES['kencana_soalfile']['type'];
        $name_file = $_FILES['kencana_soalfile']['name'];

        $name_file = explode('.', $name_file);
        $name = $name_file[0].'_'.date("Ymdhisa").'.'.$name_file[1];

        if($type_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $type_file == "application/vnd.ms-excel")
        {
            $target = APPPATH."public/soal/";
            if(!is_dir($target))
            {
                if(!mkdir($target,0777))
                    echo "failed create folder";
            }

            $target .= $name;

            if(move_uploaded_file($temp_file,$target))
            {
                /**
                 * persission
                 * read, write, execute, rewrite
                 */
                chmod($target,0777);

                /**
                 * filter file type
                 */
                if($name_file[1]==="xlsx"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    // echo "xlsx";
                elseif ($name_file[1]==="xls"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    // echo "xls";
                elseif ($name_file[1]==="csv"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    // echo "csv";
                endif;

                $Spreadsheet = $reader->load($target);
                // var_dump($Spreadsheet);
                
                $sheetData = $Spreadsheet->getActiveSheet()->toArray();
                // var_dump($sheetData);
                // die();


                $kelas = $_POST['kencana_kelasfile'];
                $kelasserialize = serialize($kelas);

                $dataFile = [
                    "idGuru"=>$_SESSION['kencana_usersession'],
                    "idMapel"=>$_POST['kencana_mapelfile'],
                    "idKelas"=>$kelasserialize
                ];
                // var_dump($dataFile);die();
                $soal = $this->model("SoalModel");
                $soalFile = $soal->store($dataFile,"insert_soal_get_id");
                // var_dump($soalFile);die();

                if(!is_null($soalFile)) {
                    
                    foreach ($sheetData as $key => $value) {
                        /**
                         * get array key
                         */
                        if($key < 1){

                            // mencari array values kunci
                            $valueCount = count($value);
                            // var_dump($valueCount);

                            for ($i=0; $i < $valueCount; $i++) { 
                                // Pertanyaan
                                if(preg_match("/pertanyaan|soal/i",$value[$i])) $pertanyaan = $i;

                                // Kunci Jawaban
                                if(preg_match("/kunci|jawaban/i",$value[$i])) $kunci = $i;
                            }

                            // $pertanyaan = implode(' ',array_keys($value,'pertanyaan'));
                            $a = implode(' ',array_keys($value,'a'));
                            $b = implode(' ',array_keys($value,'b'));
                            $c = implode(' ',array_keys($value,'c'));
                            $d = implode(' ',array_keys($value,'d'));

                        }else{
                            /**
                             * check null rows
                             */
                            if($value[$pertanyaan]!==NULL){
                                /**
                                 * get data from file
                                 */
                                $dataSoal = [
                                    'idFile' => $soalFile,
                                    'soal' => $value[$pertanyaan],
                                    'a' => is_null($a) ? "" : $value[$a],
                                    'b' => is_null($b) ? "" : $value[$b],
                                    'c' => is_null($c) ? "" : $value[$c],
                                    'd' => is_null($d) ? "" : $value[$d],
                                    'kunci' => $value[$kunci],
                                ];
                                $res = $soal->store($dataSoal,"soal_butir");
                            }
                        }
                    } // endforeach
                    // var_dump($dataSoal);die();
                    Flasher::setFlash("Berhasil menambah soal", true);
                }
                unlink($target);
            } else {
                Flasher::setFlash("Tipe file harus xls,xlsx,cls", false);
            }
        }else {
            echo "tipe file tidak diizinkan";
            Flasher::setFlash("Tipe file harus xls,xlsx,cls", false);
        }
        header("location:".BASEURL."guru/bank_soal");
    }

    public function list_kelas()
    {
        $guru = $this->model("GuruModel")->show($_SESSION['kencana_usersession'], 'id');
        $kelas = $this->model("KelasModel");
        $siswa = $this->model("SiswaModel");
        
        // Data kelas
        $kelasGuru = unserialize($guru['kelas']);
        
        for ($i=0; $i < count($kelasGuru); $i++) { 
            $res = $kelas->show($kelasGuru[$i],'id');
            $data['kelas'][] = $res;
        }

        for ($i=0; $i < count($kelasGuru) ; $i++) { 
            $res = $siswa->show($kelasGuru[$i],'select_by_joining_kelas');
            $data['listSiswa'][$kelasGuru[$i]] = Helper::null_checker($res);

            // var_dump($data['listSiswa']);
            
        }
        // die();


        $this->view("guru/kelas",$data,"admin");
    }

    public function generate_siswa()
    {
        // var_dump($_POST);
        // var_dump($_FILES);
        // die();
        $temp_file = $_FILES['guru_list_siswa']['tmp_name'];
        $type_file = $_FILES['guru_list_siswa']['type'];
        $name_file = $_FILES['guru_list_siswa']['name'];

        $name_file = explode('.', $name_file);
        $name = $name_file[0].'_'.date("Ymdhisa").'.'.$name_file[1];
        
        if( $type_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $type_file == "application/vnd.ms-excel" )
        {   
            $target = APPPATH."public/siswa/";
            if(!is_dir($target))
            {
                if(!mkdir($target,0777))
                    echo "failed create folder";
            }

            $target .= $name;

            if(move_uploaded_file($temp_file,$target))
            {
                /**
                 * persission
                 * read, write, execute, rewrite
                 */
                chmod($target,0777);

                /**
                 * filter file type
                 */
                if($name_file[1]==="xlsx"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    // echo "xlsx";
                elseif ($name_file[1]==="xls"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    // echo "xls";
                elseif ($name_file[1]==="csv"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    // echo "csv";
                endif;

                $Spreadsheet = $reader->load($target);
                // var_dump($Spreadsheet);
                
                $sheetData = $Spreadsheet->getActiveSheet()->toArray();
                // var_dump($sheetData);die();

                $user = $this->model("UserModel");
                $siswa = $this->model("SiswaModel");
                
                    foreach ($sheetData as $key => $value) {
                        /**
                         * get array key
                         */
                        if($key < 1){

                            // mencari array values kunci
                            $valueCount = count($value);
                            // var_dump($valueCount);

                            for ($i=0; $i < $valueCount; $i++) { 
                                // NIS
                                if(preg_match("/nis/i",$value[$i])) $nis = $i;
                                // Nama
                                if(preg_match("/nama/i",$value[$i])) $nama = $i;
                                // Password
                                if(preg_match("/password/i",$value[$i])) $password = $i;
                            }
                        }else{
                            /**
                             * get data from file
                             */
                            $dataSiswa = [
                                'nis' => $value[$nis],
                                'nama' => $value[$nama],
                                'idKelas' => $_POST['guru_kelas_siswa'],
                            ];

                            $dataUser = [
                                'username' => $value[$nis],
                                'password' => $value[$password],
                                'role' => 1
                            ];

                            if($result=$user->store($dataUser))
                            {
                                if($result=$siswa->store($dataSiswa)){
                                    Flasher::setFlash('Berhasil import siswa', True);
                                }
                            } else {
                                Flasher::setFlash('Gagal import siswa', False);
                            }
                        }
                    } // endforeach

            }else{
                Flasher::setFlash('Gagal Upload! silakan hubungi Administrator', False);
            }
        }

        header("location:".BASEURL."guru/list_kelas");
    }
}
