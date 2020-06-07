<?php
namespace App\Core;

class Controller
{
    /**
     * View Controller
     * @return Pageview
     * @return Array $data
     */
    public function view(String $view, $data = null, $state = null){
        switch ($state) {
            case 'admin':
                require VPATH.'templates/admin/head.php';
                require VPATH.'templates/admin/navbar.php';
                require VPATH.'templates/admin/sidebar.php';
                require VPATH.'templates/admin/content-head.php';
                require VPATH.$view.'.php';
                require VPATH.'templates/admin/content-foot.php';
                require VPATH.'templates/admin/footer.php';
                break;
            case 'single':
                require VPATH.$view.'.php';
                break;
            default:
                require VPATH.'templates/default/head.php';
                require VPATH.'templates/default/navbar.php';
                require VPATH.'templates/default/content-head.php';
                require VPATH.$view.'.php';
                require VPATH.'templates/default/content-foot.php';
                require VPATH.'templates/default/footer.php';
                break;
        }
    }
    
    /**
     * Model Controller
     * @return Model
     */
    public function model(String $model){
        $model = ucwords($model);
        require MPATH.$model.'.php';
        return new $model;
    }
}