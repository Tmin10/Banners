<?php

class campaign_model extends model{
    
    public function get_data_for_index() 
    {
        $return = array();
        sys::$mysqli->real_query("SELECT id, name, c
                                    FROM campaign
                                    LEFT JOIN 
                                    (
                                        SELECT  `campaign_id` AS cid, COUNT( * ) AS c
                                        FROM  `banner` 
                                        WHERE user_id =  '1'
                                            AND display =  '1'
                                        GROUP BY `campaign_id`
                                    ) AS t 
                                    ON id = cid 
                                    WHERE user_id = '".sys::get_user_id()."' "
                                         . "AND display='1'");
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
    
    public function add_new_campaign()
    {
        if (!filter_has_var(INPUT_POST, 'new-campaign-name')||filter_input(INPUT_POST, 'new-campaign-name', FILTER_SANITIZE_STRING)=='')
        {
            $_SESSION['error']['msg'][]='No campaign name.';
        }
        if (!isset($_SESSION['error']['msg']))
        {
            sys::$mysqli->real_query("INSERT INTO `campaign`(`user_id`, `name`) "
                    . "VALUES ('".sys::get_user_id()."', '".sys::$mysqli->real_escape_string(filter_input(INPUT_POST, 'new-campaign-name', FILTER_SANITIZE_STRING))."')");
        }
        else
        {
            $_SESSION['error']['open'] = 'new';
        }
         
    }
    
    public function delete_campaign() 
    {
        if (filter_has_var(INPUT_POST, 'campaign-id'))
        {
            $campaign_id = (int) filter_input(INPUT_POST, 'campaign-id', FILTER_SANITIZE_NUMBER_INT);
            sys::$mysqli->real_query("UPDATE campaign SET display = '0' WHERE id ='$campaign_id'");
        }
    }
    
    public function show_edit_campaign() 
    {
        $return = array();
        if (filter_has_var(INPUT_POST, 'campaign-id'))
        {
            $campaign_id = (int) filter_input(INPUT_POST, 'campaign-id', FILTER_SANITIZE_NUMBER_INT);
            sys::$mysqli->real_query("SELECT name, id FROM campaign WHERE user_id = '".sys::get_user_id()."' AND display='1' AND id = '$campaign_id'");
            $result = sys::$mysqli->store_result();
            if ($result->num_rows===1)
            {
                $return['campaign'] = $result->fetch_row();
            }
        }
        return $return;
    }
    
    public function edit_campaign() 
    {
        if (!filter_has_var(INPUT_POST, 'new-campaign-name')||filter_input(INPUT_POST, 'new-campaign-name', FILTER_SANITIZE_STRING)=='')
        {
            $_SESSION['error']['msg'][]='No campaign name.';
        }
        if (!isset($_SESSION['error']['msg']))
        {
            $campaign_id = (int) filter_input(INPUT_POST, 'campaign-id', FILTER_SANITIZE_NUMBER_INT);
            sys::$mysqli->real_query("UPDATE campaign "
                    . "SET name = '".sys::$mysqli->real_escape_string(filter_input(INPUT_POST, 'new-campaign-name', FILTER_SANITIZE_STRING))."'"
                    . "WHERE id = '$campaign_id' AND user_id='".sys::get_user_id()."' AND display='1'");
        }
        else
        {
            $_SESSION['error']['open'] = 'list';
        }
    }
    
}
