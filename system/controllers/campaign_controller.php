<?php

class campaign_controller {
    
    function __construct()
    {
        if (!sys::is_autorised())
        {
            header("location:".conf::BASE_URL);
            die();
        }
        $this->model = new campaign_model();
        $this->view = new View();
    }
    
    function index_action()
    {
        //$data = $this->model->get_data();
        $this->view->render('campaign_view.php', 'main_temp.php');
    }
    
    function new_action()
    {
        //$data = $this->model->get_data();
        $this->view->render('campaign_view.php', 'main_temp.php');
    }
    
}
