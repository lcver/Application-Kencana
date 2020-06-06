<?php

use App\Core\Controller;

class AdministrationController extends Controller
{
    public function index()
    {
        $this->view("admin/index",[],"admin");
    }

    public function tambah_guru()
    {
        $mapel = $this->model("MapelModel");
        $kelas = $this->model("KelasModel");

        $res = $mapel->show("lokal");
        $data['mapel_lokal'] = $res;
        
        $res = $mapel->show("umum");
        $data['mapel_umum'] = $res;

        $res = $kelas->create();
        $data['kelas'] = $res;

        $this->view("admin/create_guru",$data,"admin");
    }
    
    public function tambah_siswa()
    {
        $res = $this->model("KelasModel")->create();
        $data['kelas'] = $res;
        $this->view("admin/create_siswa",$data,"admin");
    }

    public function create_siswa()
    {
    }

    public function create_guru()
    {
        $guru = $this->model("GuruModel");
        $user = $this->model("userModel");
        
        $dataGuru = [
            "nama_pengguna"=>$_POST['kencana_admin_namapenggunaguru'],
            "nama"=>$_POST['kencana_admin_namalengkapguru'],
            "role"=>$_POST['kencana_admin_roleguru'],
            "matapelajaran"=>serialize($_POST['kencana_admin_mapelguru']),
            "kelas"=>serialize($_POST['kencana_admin_kelasguru'])
        ];

        $dataUser = [
            "username"=>$_POST['kencana_admin_namapenggunaguru'],
            "password"=>$_POST['kencana_admin_passwordguru'],
            "role"=>2
        ];

        try{
            $guru->store($dataGuru);
            $user->store($dataUser);
            Flasher::setFlash("Berhasil menambah guru", true);
        } catch(Exception $e)
        {
            Flasher::setFlash($e->getMessage(), false);
        }

        header("location:".BASEURL."administration/tambah_guru");
    }
}
