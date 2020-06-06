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

        $res = $mapel->show("lokal","muatan");
        $data['mapel_lokal'] = $res;
        
        $res = $mapel->show("umum","muatan");
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
        $siswa = $this->model("SiswaModel");
        $user = $this->model("UserModel");

        $dataSiswa = [
            "nis"=>$_POST['kencana_admin_nissiswa'],
            "nama"=>$_POST['kencana_admin_namasiswa'],
            "idKelas"=>$_POST['kencana_admin_kelassiswa']
        ];

        $dataUser = [
            "username"=>$_POST['kencana_admin_nissiswa'],
            "password"=>$_POST['kencana_admin_passwordsiswa'],
            "role"=>1
        ];

        try{
            $siswa->store($dataSiswa);
            $user->store($dataUser);
            Flasher::setFlash("Berhasil menambah siswa", true);
        } catch(Exception $e)
        {
            Flasher::setFlash($e->getMessage(), false);
        }

        header("location:".BASEURL."administration/tambah_siswa");
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

        // var_dump($dataGuru);die();

        try{
            if ($guru->store($dataGuru)) {
                if($user->store($dataUser))
                {
                    Flasher::setFlash("Berhasil menambah guru", true);
                } else {
                    throw new FailedtoCreateUserException("Failed to create user");
                }
            } else {
                throw new FailedtoCreateGuruException("Failed to create guru");
            }
        } catch (FailedtoCreateUserException $e)
        {
            Flasher::setFlash($e->getMessage(), false);
        } catch (FailedtoCreateGuruException $e)
        {
            Flasher::setFlash($e->getMessage(), false);
        } catch(Exception $e)
        {
            Flasher::setFlash($e->getMessage(), false);
            die();
        }

        header("location:".BASEURL."administration/tambah_guru");
    }
}
