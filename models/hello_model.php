<?php
class Hello_Model extends CI_Model 
{
    //register
	function saverecords($data)
	{
	$this->db->insert('register',$data); 
	}
	// showing all car
	function displayrecords()
	{
	$query=$this->db->query("select * from car_data");
	return $query->result();
	}

    //login process
	public function process($email,$pass)  
    {   
        if ($email!='' && $pass!='')   
        {  
            //declaring session  
            $this->session->set_userdata(array('email'=>$email)); 
            $query=$this->db->query("select * from register where email =" . "'". $email . "'"); 
            if ($query->num_rows() == 1) {
                $a=$query->result();
                $session = $this->session->set_userdata('user',$a[0]);
                return true;
                } else {
                return false;
                }
                
        }  
       
    }  

    public function getCarById($id)  
    {   
        if ($id!='')   
        {  
            $query=$this->db->query("select * from car_data where id =" . "'". $id . "'"); 
            if ($query->num_rows() == 1) {
                $a=$query->result();
             return $a[0];
                }
                
        }  
       
    } 
    
}

?>