<?php
class ajax_controller extends Controller{

    function __construct()
    {
        if (!sys::is_autorised())
        {
            header("location:".conf::BASE_URL);
            die();
        }
        $this->model = new ajax_model();
        $this->view = new View();
    }
    
}