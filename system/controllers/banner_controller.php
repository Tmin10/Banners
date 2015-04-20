<?php

class banner_controller extends controller{
    
    function __construct()
    {
        if (!sys::is_autorised())
        {
            header("location:".conf::BASE_URL);
            die();
        }
        $this->model = new banner_model();
        $this->view = new View();
    }
    
    function index_action()
    {
        $data = $this->model->get_data_for_index();
        if (isset($_SESSION['error']))
        {
            $data['error']=$_SESSION['error'];
            unset($_SESSION['error']);
        }
        $this->view->render('banner_view.php', 'main_temp.php', $data);
    }
    
    function add_new_action()
    {
        $this->model->add_new_banner();
        header("location:".conf::BASE_URL.'banner');
    }
    
    function edit_action()
    {
        $data = $this->model->show_edit_banner();
        $this->view->render('banner_edit_view.php', 'main_temp.php', $data);
    }
    
    function save_edit_action()
    {
        $this->model->edit_banner();
        header("location:".conf::BASE_URL.'banner');
    }
    
    function delete_action()
    {
        $this->model->delete_banner();
        header("location:".conf::BASE_URL.'banner');
    }
        
}
