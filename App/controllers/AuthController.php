<?php

use App\Core\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        if(isset($_SESSION['kencana_usersession']))
        {
            switch ($_SESSION['kencana_rolesession']) {
                case 1:
                    header('location:'.BASEURL);
                    break;
                case 2:
                    header('location:'.BASEURL.'guru');
                    break;
                case 3:                    
                    header('location:'.BASEURL.'administration');
                    break;
                case 4:
                    header('location:'.BASEURL.'kasek');
                    break;
                case 5:
                    header('location:'.BASEURL.'superadmin');
                    break;
                
                default:
                    header('location:'.BASEURL.'auth');
                    break;
            }
        }
    }
    public function index()
    {
        $this->view('auth/index',[],'single');
    }

    public function validation()
    {
        $user = $this->model("UserModel");
        $guru = $this->model("GuruModel");
        $siswa = $this->model("SiswaModel");

        $dataSign['username'] = $_POST['kencana_username'];
        $dataSign['password'] = $_POST['kencana_password'];
        
        $res = $user->authentication($dataSign);

        if(!is_null($res))
        {

            
            /**
             * ROLE
             * 1 = siswa
             * 2 = guru
             * 3 = tata usaha
             * 4 = kasek
             * 5 = superadmin
             */
            switch ($res['role']) {
                case 1:
                    $siswa = $siswa->show($res['username']);

                    $_SESSION['kencana_namasession'] = $siswa['nama'];
                    $_SESSION['kencana_usersession'] = $res['id'];
                    $_SESSION['kencana_rolesession'] = $res['role'];
                    header('location:'.BASEURL);
                    break;
                case 2:
                    $guru = $guru->show($res['username']);

                    $_SESSION['kencana_namasession'] = $guru['nama'];
                    $_SESSION['kencana_usersession'] = $res['id'];
                    $_SESSION['kencana_rolesession']  = $res['role'];
                    header('location:'.BASEURL.'guru');
                    break;
                case 3:
                    $_SESSION['kencana_usersession'] = $res['id'];
                    $_SESSION['kencana_rolesession']  = $res['role'];
                    header('location:'.BASEURL.'administration');
                    break;
                case 4:
                    $_SESSION['kencana_usersession'] = $res['id'];
                    $_SESSION['kencana_rolesession']  = $res['role'];
                    header('location:'.BASEURL.'kasek');
                    break;
                case 5:
                    $_SESSION['kencana_usersession'] = $res['id'];
                    $_SESSION['kencana_rolesession']  = $res['role'];
                    header('location:'.BASEURL.'superadmin');
                    break;
                
                default:
                header('location:'.BASEURL.'auth');
                    break;
            }
        }else {
            header('location:'.BASEURL.'auth');
        }
    }

    public function logout()
    {
        session_destroy();
        header('location:'.BASEURL.'auth');
    }
}
