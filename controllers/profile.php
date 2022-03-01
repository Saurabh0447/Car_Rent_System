<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
	public function saveprofile()
	{
		$this->load->model('Reg_Model');
        // add car 
        $data = array(  
                        'username'     => $this->input->post('username'),  
                        'email' => $this->input->post('email'),
                        'number' => $this->input->post('number'),
                        'password' => $this->input->post('password'),
                        'gender' => $this->input->post('gender'),
                        'dob' => $this->input->post('dob')
                        );  
        //insert data into database table.  
        $this->Reg_Model->profile($data); 
  
        redirect("layout/login"); 

	}

    function login (){
        
        $this->load->model('Reg_Model');
  
        $email= $this->input->post('email');
        $pass= $this->input->post('password');

        $res=$this->Reg_Model->process($email,$pass);
        //redirect("welcome");
      
            if($res){

            redirect("layout"); 
        } else{  
            $data['error'] = 'Your Account is Invalid';  
        }  
 
    }
      
    
    
    //driver register

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

    public function addmorecar()
	{

		$config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

		$this->load->model('Car_Model');
		$this->load->library('upload', $config);

         $path =  'http://localhost/Car_Rent_System/';
        // add car 
        $data = array(  
						'name'     => $this->input->post('name'),
						'email'     => $this->input->post('email'),
						'phone_no'     => $this->input->post('phone_no'),
                        'car_name'     => $this->input->post('car_name'),  
                        'car_model'    => $this->input->post('car_model'),
                        'car_price'    => $this->input->post('car_price'),
						'drli'         => $path .'upload//'.$this->input->post('drli'),
						'img'          => $path .'upload//'. $this->input->post('img')
                        );  
        //insert data into database table.  
        $this->Car_Model->saving($data); 
  
        redirect("layout/thanks");
		// redirect("welcome/edit"); 

	}

}

?>