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

        $this->view("guru/bank_soal",$data,"admin");
    }

    public function generate_soal()
    {
        // var_dump($_FILES['kencana_soalfile']);
        $kelas = $_POST['kencana_kelasfile'];
        $kelasserialize = serialize($kelas);
        $kelasunserialize = unserialize($kelasserialize);

        var_dump($kelasserialize."\n");
        var_dump($kelasunserialize);


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
                    echo "xlsx";
                elseif ($name_file[1]==="xls"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    echo "xls";
                elseif ($name_file[1]==="csv"):
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    echo "csv";
                endif;

                $Spreadsheet = $reader->load($target);
                // var_dump($Spreadsheet);
                
                $sheetData = $Spreadsheet->getActiveSheet()->toArray();
                // var_dump($sheetData);
                // die();

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

                        }else{
                            /**
                             * check null rows
                             */
                            if($value[$pertanyaan]!==NULL){
                                /**
                                 * get data from file
                                 */
                                $dataSoal[] = [
                                    'idFile' => "id file",
                                    'soal' => $value[$pertanyaan],
                                    'a' => $value[$a],
                                    'b' => $value[$b],
                                    'c' => $value[$c],
                                    'kunci' => $value[$kunci],
                                ];
                            }
                        }
                    } // endforeach
                    var_dump($dataSoal);
            }
            unlink($target);
        }else {
            echo "tipe file tidak diizinkan";
        }
    }

    public function list_kelas()
    {
        
    }
}
