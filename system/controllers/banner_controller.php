<?php

class banner_controller extends controller{
    
    function __construct()
    {
        $this->model = new banner_model();
        $this->view = new View();
    }
    
    function index_action()
    {
        //$data = $this->model->get_data();
        $this->view->render('banner_view.php', 'main_temp.php');
    }
    
    function new_action()
    {
        //$data = $this->model->get_data();
        $this->view->render('banner_view.php', 'main_temp.php');
    }
    
}
