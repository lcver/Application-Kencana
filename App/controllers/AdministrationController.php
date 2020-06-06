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
}
