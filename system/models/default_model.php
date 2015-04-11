<?php

class default_model extends model {
    
    public function get_data()
    {	
      $return=array();
      if (!sys::is_autorised())
      {
         //Получим списки факультетов для вывода в окне авторизации
         $SQL="SELECT `id`, `first_name`, `last_name`, `middle_name` FROM `users` ORDER BY `last_name`";
         sys::$mysqli->real_query($SQL);
         $result = sys::$mysqli->store_result();
         if ($result->num_rows>0)
         {
            while ($row=$result->fetch_row())
            {
               $return['names'][]=$row;
            }
         }
         else 
         {
            $return['names'][]=array('0', 'Пользователей не обнаружено');
         }
      }
      return $return;
    }
    public function get_data_main()
    {
      $return=array();
      $SQL="SELECT `years`.`id`, `years`.`year`, `years`.`semester` 
          FROM `years` 
          LEFT JOIN `users_years` ON `users_years`.`year_id`=`years`.`id` 
          WHERE `users_years`.`user_id`='".(int)$_SESSION['id']."'
          ORDER BY `years`.`year`, `years`.`semester`";
      sys::$mysqli->real_query($SQL);
      $result = sys::$mysqli->store_result();
      if ($result->num_rows>0)
      {
        while ($row=$result->fetch_row())
        {
          $return[]=$row;
        }
      }
      return $return;
    }
    
}
