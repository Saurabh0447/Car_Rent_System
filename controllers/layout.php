<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
	
	public function index()
	{
		// redirect("/layout"); 
		$this->load->model('Hello_Model');
		 $result['data']=$this->Hello_Model->displayrecords();
		 $this->load->library('session');
		$profile['user'] = $this->session->userdata('profile');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header', $profile);
		$this->load->view('carbook-master/index', $result);
		$this->load->view('carbook-master/include/footer', $res);
	}

	public function about()
	{
		$profile['user'] = $this->session->userdata('profile');
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header', $profile);
		$this->load->view('carbook-master/about' );
		$this->load->view('carbook-master/include/footer');
	}

	public function car_single($id)
	{
		$this->load->model('Hello_Model');
		$this->load->library('session');
		$result['edit']=$this->Hello_Model->getCarById($id);
		$profile['user'] = $this->session->userdata('profile');
		$list['data']=$this->Hello_Model->displayrecords();
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header',$profile);
		$this->load->view('carbook-master/car-single', $result['edit'],$profile);
		$this->load->view('carbook-master/carlist', $list);
		$this->load->view('carbook-master/include/footer');
	}

	public function car()
	{
		$this->load->model('Hello_Model');
		$profile['user'] = $this->session->userdata('profile');
		 $result['data']=$this->Hello_Model->displayrecords();
		 $this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header',$profile);
		$this->load->view('carbook-master/car');
		$this->load->view('carbook-master/carlist', $result);
		$this->load->view('carbook-master/include/footer');
	}

	public function contact()
	{
		$profile['user'] = $this->session->userdata('profile');
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header',$profile);
		$this->load->view('carbook-master/contact',$res);
		$this->load->view('carbook-master/include/footer');
	}

	public function pricing()
	{
		$profile['user'] = $this->session->userdata('profile');
		$this->load->model('Hello_Model');
		$result['data']=$this->Hello_Model->displayrecords();
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header',$profile);
		$this->load->view('carbook-master/pricing', $result);
		$this->load->view('carbook-master/include/footer',$res);
	}

	public function services()
	{
		$profile['user'] = $this->session->userdata('profile');
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header',$profile);
		$this->load->view('carbook-master/services');
		$this->load->view('carbook-master/include/footer',$res);
	}
	public function driverreg()
	{
		$profile['user'] = $this->session->userdata('profile');
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header',$profile);
		$this->load->view('carbook-master/driverreg');
		$this->load->view('carbook-master/include/footer',$res);
	}

	public function login()
	{
		$this->load->view('carbook-master/login');
	}

	public function thanks()
	{
		$this->load->library('session');
		$profile['user'] = $this->session->userdata('profile');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header', $profile);
		$this->load->view('carbook-master/thanks');
		$this->load->view('carbook-master/include/footer',$res);
	}

	public function privacy()
	{
		$this->load->library('session');
		$profile['user'] = $this->session->userdata('profile');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('carbook-master/include/header', $profile);
		$this->load->view('carbook-master/privacy');
		$this->load->view('carbook-master/include/footer',$res);
	}

	public function register()
	{
		$this->load->view('carbook-master/register');
	}

	public function forgetpass()
	{
		$this->load->view('carbook-master/forgetpass');
	}


	public function AddCar()
	{
		$profile['user'] = $this->session->userdata('profile');
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('template/include/header',$res,$profile );
		$this->load->view('template/pages/addcar');
		$this->load->view('template/include/footer');

	}

	public function savecar()
	{
		$this->load->model('Car_Model');
        // add car 
        $data = array(  
                        'car_name'     => $this->input->post('car_name'),  
                        'car_model' => $this->input->post('car_model'),
                        'car_price' => $this->input->post('car_price'),
                        );  
        //insert data into database table.  
        $this->Car_Model->saving($data); 
  
        redirect("welcome/tabel"); 

	}

	public function dashboard()
	{
		$this->load->view('login');
	}

	public function data()
	{
		$this->load->model('Reg_Model');
        // add car 
        $data = array(  
                        'name'     => $this->input->post('name'),  
                        'email' => $this->input->post('email'),
                        'subject' => $this->input->post('subject'),
                        'message' => $this->input->post('message')
                        );  
        //insert data into database table.  
        $this->Reg_Model->contact($data); 
  
        redirect("layout/contact"); 

	}

	public function book()
	{
		$this->load->model('Car_Model');
        // book car 
        $data = array(  
						'name'  => $this->input->post('name'),
						'email'  => $this->input->post('email'),
						'car_name'  => $this->input->post('car_name'),
						'car_model'  => $this->input->post('car_model'),
						'car_price'  => $this->input->post('car_price'),
						'pick_up'     => $this->input->post('pick_up'),
						'drop_off'     => $this->input->post('drop_off'),
						'pick_date'     => $this->input->post('pick_date'),
                        'drop_date'     => $this->input->post('drop_date'),  
                        'time'    => $this->input->post('time'),
                        );  
        //insert data into database table.  
        $this->Car_Model->book($data); 
  
        redirect("layout/thanks");
		// redirect("welcome/edit"); 

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('layout'));
	   }
}
?>