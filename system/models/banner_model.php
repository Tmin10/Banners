<?php

class banner_model extends model
{
    
    public function get_data_for_index() 
    {
        $return = array();
        sys::$mysqli->real_query("SELECT id, campaign_id, name, banner_code, moderated FROM banner WHERE user_id = '".sys::get_user_id()."' AND display='1'");
        $result = sys::$mysqli->store_result();
        if ($result->num_rows>0)
        {
            while ($row=$result->fetch_row())
            {
                $return['banners'][] = $row;
            }
        }
        else
        {
            $return['banners'] = array();
        }
        return $return;
    }
    
    public function add_new_banner()
    {
        if (!filter_has_var(INPUT_POST, 'new-banner-name')||filter_input(INPUT_POST, 'new-banner-name', FILTER_SANITIZE_STRING)=='')
        {
            $_SESSION['error']['msg'][]='No banner name.';
        }
        if (!filter_has_var(INPUT_POST, 'new-banner-code')||filter_input(INPUT_POST, 'new-banner-code', FILTER_SANITIZE_FULL_SPECIAL_CHARS)=='')
        {
            $_SESSION['error']['msg'][]='No banner code.';
        }
        if (!isset($_SESSION['error']['msg']))
        {
            sys::$mysqli->real_query("INSERT INTO `banner`(`user_id`, `name`, `banner_code`) "
                    . "VALUES ('".sys::get_user_id()."', '".sys::$mysqli->real_escape_string(filter_input(INPUT_POST, 'new-banner-name', FILTER_SANITIZE_STRING))."', '".sys::$mysqli->real_escape_string(filter_input(INPUT_POST, 'new-banner-code', FILTER_SANITIZE_FULL_SPECIAL_CHARS))."')");
        }
        else
        {
            $_SESSION['error']['open'] = 'new';
        }
         
    }
    
    public function delete_banner() 
    {
        if (filter_has_var(INPUT_POST, 'banner-id'))
        {
            $banner_id = (int) filter_input(INPUT_POST, 'banner-id', FILTER_SANITIZE_NUMBER_INT);
            sys::$mysqli->real_query("UPDATE banner SET display = '0' WHERE id ='$banner_id'");
        }
    }
    
    public function show_edit_banner() 
    {
        $return = array();
        if (filter_has_var(INPUT_POST, 'banner-id'))
        {
            $banner_id = (int) filter_input(INPUT_POST, 'banner-id', FILTER_SANITIZE_NUMBER_INT);
            sys::$mysqli->real_query("SELECT name, banner_code, id FROM banner WHERE user_id = '".sys::get_user_id()."' AND display='1' AND id = '$banner_id'");
            $result = sys::$mysqli->store_result();
            if ($result->num_rows===1)
            {
                $return['banner'] = $result->fetch_row();
            }
        }
        return $return;
    }
    
    public function edit_banner() 
    {
        if (!filter_has_var(INPUT_POST, 'new-banner-name')||filter_input(INPUT_POST, 'new-banner-name', FILTER_SANITIZE_STRING)=='')
        {
            $_SESSION['error']['msg'][]='No banner name.';
        }
        if (!filter_has_var(INPUT_POST, 'new-banner-code')||filter_input(INPUT_POST, 'new-banner-code', FILTER_SANITIZE_FULL_SPECIAL_CHARS)=='')
        {
            $_SESSION['error']['msg'][]='No banner code.';
        }
        if (!isset($_SESSION['error']['msg']))
        {
            $banner_id = (int) filter_input(INPUT_POST, 'banner-id', FILTER_SANITIZE_NUMBER_INT);
            sys::$mysqli->real_query("UPDATE banner "
                    . "SET name = '".sys::$mysqli->real_escape_string(filter_input(INPUT_POST, 'new-banner-name', FILTER_SANITIZE_STRING))."', "
                    . "banner_code = '".sys::$mysqli->real_escape_string(filter_input(INPUT_POST, 'new-banner-code', FILTER_SANITIZE_FULL_SPECIAL_CHARS))."' "
                    . "WHERE id = '$banner_id' AND user_id='".sys::get_user_id()."' AND display='1'");
        }
        else
        {
            $_SESSION['error']['open'] = 'list';
        }
    }
    
    
    
}
