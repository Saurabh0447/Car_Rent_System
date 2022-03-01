<?php
class Reg_Model extends CI_Model 
{
    //profile
	function profile($data)
	{
	$this->db->insert('profile',$data); 
	}

    function displaybook()
	{
	$query=$this->db->query("select * from car_book");
	return $query->result();
	}


	//contect
	function contact($data)
	{
	$this->db->insert('contact',$data); 
	}
	function displayrecords()
	{
	$query=$this->db->query("select * from contact");
	return $query->result();
	}

	public function process($email,$pass)  
    {   
        if ($email!='' && $pass!='')   
        {  
            //declaring session  
            $this->session->set_userdata(array('email'=>$email)); 
            $query=$this->db->query("select * from profile where email =" . "'". $email . "'"); 
            if ($query->num_rows() == 1) {
                $a=$query->result();
                $session = $this->session->set_userdata('profile',$a[0]);
                return true;
                } else {
                return false;
                }
                
        }  
       
    }  
}

?>