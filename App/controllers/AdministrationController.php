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
        $res = $this->model("MapelModel")->show("lokal");
        $data['mapel'] = $res;

        $this->view("admin/create_guru",$data,"admin");
    }
    
    public function tambah_siswa()
    {
        $res = $this->model("KelasModel")->create();
        $data['kelas'] = $res;
        $this->view("admin/create_siswa",$data,"admin");
    }
}
