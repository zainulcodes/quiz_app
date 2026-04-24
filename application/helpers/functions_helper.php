<?php
/**
 * Global function
 * place for all global function
 */

if (!function_exists('dump')) {
    function dump($var, $echo = TRUE)
    {

        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;"> Dump => ' . $output . '</pre>';

        if ($echo == TRUE) {
            echo $output;
        } else {
            return $output;
        }
    }
}

if (!function_exists('is_login')) {
    function is_login($type = NULL)
    {
        $CI =& get_instance();
        $CI->load->library('session');

        if (!is_null($type)) {
            if ($CI->session->userdata('logged_in_' . $type))
                return true;
        } else {
            if ($CI->session->userdata('logged_in'))
                return true;
        }
        return false;
    }
}

if (!function_exists('do_login')) {
    function do_login($userid, $username, $email, $logged_in, $role, $type = NULL)
    {
        global $CI;
        $arr = array(
            'id' => $userid,
            'name' => $username,
            'email' => $email,
            'logged_in' => $logged_in,
            'role' => $role
        );
        if (!is_null($type)) {
            if ($CI->session->set_userdata('logged_in_' . $type, $arr))
                return true;
        } else {
            if ($CI->session->set_userdata('logged_in', $arr))
                return true;
        }
        return false;
    }
}

if (!function_exists('get_logged_in')) {
    function get_logged_in($type = NULL)
    {
        global $CI;
        if (!is_null($type))
            return $CI->session->userdata('logged_in_' . $type);
        else
            return $CI->session->userdata('logged_in');
    }
}


// function _only_logged_in()
// {
//     if (is_login()) {
//         redirect('quiz', 'refresh');
//     }
// }