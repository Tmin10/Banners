<?php

class campaign_model extends model{
    
    public function get_data_for_index() 
    {
        $return = array();
        sys::$mysqli->real_query("SELECT id, name FROM campaign WHERE user_id = '".sys::get_user_id()."' AND display='1'");
        $result = sys::$mysqli->store_result();
        if ($result->num_rows>0)
        {
            while ($row=$result->fetch_row())
            {
                $return['campaigns'][] = $row;
            }
        }
        else
        {
            $return['campaigns'] = array();
        }
        return $return;
    }
    
}
