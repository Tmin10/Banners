<?php

class login_model extends model {
    
    
    public function get_data()
    {
        if (isset($_POST['password']))
        {
            $temp_auth=sys::autorization($_POST['email'], $_POST['password']);
            if ($temp_auth===true)
            {
                header("location:".conf::BASE_URL);
            }
            else
            {
                switch ($temp_auth)
                {
                    case 'error_password':
                       $_SESSION['login_error']['email']=(int)$_POST['email'];
                       header("location:".conf::BASE_URL);
                       break;
                }
            }
        }
        else
        {
            header("location:".conf::BASE_URL);
        }
    }
    
}