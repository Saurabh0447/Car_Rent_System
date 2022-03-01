<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Car_Model');
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$list['list'] = $this->Car_Model->countRow();
		$book['book'] = $this->Car_Model->countbook();
		$contact['contact'] = $this->Car_Model->countcontact();
		$this->load->view('template/include/header',$res );
	     $this->load->view('template/index',$list);
		 $this->load->view('template/books',$book);
		 $this->load->view('template/customer',$contact);
		 $this->load->view('template/include/footer');
	}

	public function table()
	{
		$this->load->model('Hello_Model');
		//showing all data 
		$result['data']=$this->Hello_Model->displayrecords();
		//showing username and email
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('template/include/header',$res );
		
		$this->load->view('template/pages/basic-tables',$result);
		$this->load->view('template/include/footer');

	}

	public function contactus()
	{
		$this->load->model('Reg_Model');
		//showing all data 
		$result['data']=$this->Reg_Model->displayrecords();
		//showing username and email
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('template/include/header',$res );
		
		$this->load->view('template/pages/contactus',$result);
		$this->load->view('template/include/footer');

	}

	public function profile()
	{
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('template/include/header',$res);
	     $this->load->view('template/pages/profile',$res);
		 $this->load->view('template/include/footer');
	}

	public function addcar()
	{
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('template/include/header',$res );
		$this->load->view('template/pages/addcar');
		$this->load->view('template/include/footer');

	}

	public function booklist()
	{
		$this->load->model('Reg_Model');
		//showing all data 
		$result['data']=$this->Reg_Model->displaybook();
		//showing username and email
		$this->load->library('session');
		$res['data'] = $this->session->userdata('user');
		$this->load->view('template/include/header',$res );
		$this->load->view('template/pages/booklist',$result);
		$this->load->view('template/include/footer');
	}

	public function edit($id)
	{ 
		
		$this->load->library('session');
		$this->load->model('Hello_Model');
		$result['edit']=$this->Hello_Model->getCarById($id);
		$res['data'] = $this->session->userdata('user');
		// echo '<pre>';
		// print_r($result['edit']);
		// die;
		$this->load->view('template/include/header',$res );
		$this->load->view('template/pages/edit', $result['edit']);
		$this->load->view('template/include/footer');

	}

	

	public function savecar()
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
  
        redirect("welcome/table");
		// redirect("welcome/edit"); 

	}

	public function update($id)
	{

		$config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

		$this->load->model('Car_Model');
		$this->load->library('upload', $config);

         $path =  'http://localhost/Car_Rent_System/';
        // add car 
        $data = array(  
			        
                        'car_name'     => $this->input->post('car_name'),  
                        'car_model' => $this->input->post('car_model'),
                        'car_price' => $this->input->post('car_price'),
						'img' =>       $path .'upload//' .$this->input->post('img')
                        );  
				// $id=$this->input->post('id'); 		
        //insert data into database table.  
        $this->Car_Model->updateCar($data, $id); 
  
        redirect("welcome/table");
		// redirect("welcome/edit"); 

	}

	public function delete($id)
	{
		$this->load->model('Car_Model');
		$this->Car_Model->delete_item($id); 
	    redirect(base_url('welcome/table'));
	}

	public function register()
	{
		$this->load->view('form');
	}

	

}
?>


