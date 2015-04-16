<?php
class default_controller extends controller{
    function __construct()
    {
      $this->model = new default_model();
      $this->view = new View();
    }

    function index_action()
    {
      if (sys::is_autorised())
      {
        $data = $this->model->get_data_main();
        $this->view->render('default_view.php', 'main_temp.php', $data);
      }
      else
      {
        $data = $this->model->get_data();
        if (isset($_SESSION['login_error']))
        {
          $data['login_error']=$_SESSION['login_error'];
          unset($_SESSION['login_error']);
        }
        $this->view->render('unreg_view.php', 'unreg_temp.php', $data);
      }
    }
}