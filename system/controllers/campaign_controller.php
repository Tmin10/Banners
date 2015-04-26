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
        $data = $this->model->get_data_for_index();
        if (isset($_SESSION['error']))
        {
            $data['error']=$_SESSION['error'];
            unset($_SESSION['error']);
        }
        $this->view->render('campaign_view.php', 'main_temp.php', $data);
    }
    
    function add_new_action()
    {
        $this->model->add_new_campaign();
        header("location:".conf::BASE_URL.'campaign');
    }
    
    function edit_action()
    {
        $data = $this->model->show_edit_campaign();
        $this->view->render('campaign_edit_view.php', 'main_temp.php', $data);
    }
    
    function save_edit_action()
    {
        $this->model->edit_campaign();
        header("location:".conf::BASE_URL.'campaign');
    }
    
    function delete_action()
    {
        $this->model->delete_campaign();
        header("location:".conf::BASE_URL.'campaign');
    }
    
}
