<?php
class ajax_controller extends Controller{

  function __construct()
  {
    $this->model = new ajax_model();
    $this->view = new View();
  }
   
  function get_lines_by_year_id_action()
  {
    $data = $this->model->get_lines_by_year_id();
    //У представления ajax данных будет только 1 файл
    $this->view->render('', 'ajax_view.php', $data);
  }
  
  function save_line_action()
  {
    $data = $this->model->save_line();
    //У представления ajax данных будет только 1 файл
    $this->view->render('', 'ajax_view.php', $data);
  }
  
  function delete_line_action()
  {
    $data = $this->model->delete_line();
    //У представления ajax данных будет только 1 файл
    $this->view->render('', 'ajax_view.php', $data);
  } 
  
  function update_line_action()
  {
    $data = $this->model->update_line();
    //У представления ajax данных будет только 1 файл
    $this->view->render('', 'ajax_view.php', $data);
  } 
  
  
   function add_semester_action()
  {
    $data = $this->model->add_semester();
    //У представления ajax данных будет только 1 файл
    $this->view->render('', 'ajax_view.php', $data);
  } 
 
    
}