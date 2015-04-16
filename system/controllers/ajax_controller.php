<?php
class ajax_controller extends Controller{

    function __construct()
    {
        $this->model = new ajax_model();
        $this->view = new View();
    }
    
}