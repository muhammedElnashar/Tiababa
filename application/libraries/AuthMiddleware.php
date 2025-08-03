<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthMiddleware {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function checkLogin() {
        if (!$this->CI->session->userdata('user_logged_in')) {
            redirect('auth/login');
            exit;
        }
    }
}
