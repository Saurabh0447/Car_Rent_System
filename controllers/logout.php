<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function index() {
        $this->session->unset_userdata(array('id', 'name'));
        $this->session->set_flashdata('alert', array('type' => 'info', 'msg' => 'You are logged out.'));
        redirect(base_url('login'));
    }
}

?>