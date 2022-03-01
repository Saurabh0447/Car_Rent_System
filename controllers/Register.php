<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() 
    {
        $this->load->view('login');
    }
    public function test()
    {
        $this->load->view('form');
    }

    function savingdata()  
    {  
        $this->load->model('Hello_Model');
        
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('template/pages/profile', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $this->load->view('template/pages/profile', $data);
        }

        $path =  'http://localhost/Car_Rent_System/';
        // register 
        $data = array(  
                        'username'     => $this->input->post('username'),  
                        'email' => $this->input->post('email'),
                        'phone_no' => $this->input->post('phone_no'),
                        'address' => $this->input->post('address'),
                        'password' => $this->input->post('password'),
                        'img' =>       $path .'upload//' .$this->input->post('img')
                        );  
        //insert data into database table.  
        $this->Hello_Model->saverecords($data); 
  
        redirect("register/index"); 
         
        
    }  
// login
    function auth (){
        
        $this->load->model('Hello_Model');
  
        $email= $this->input->post('email');
        $pass= $this->input->post('password');

        $res=$this->Hello_Model->process($email,$pass);
        //redirect("welcome");
      
            if($res){

            redirect("welcome"); 
        } else{  
            $data['error'] = 'Your Account is Invalid';  
        }  
 
    }

    
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('register'));
	   } 
}
?>