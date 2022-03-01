<?php
class Car_Model extends CI_Model 
{
    //save car
	function saving($data)
	{
	$this->db->insert('car_data',$data); 
	}

	//car book

	function book($data)
	{
	$this->db->insert('car_book',$data); 
	}

	// for Id
	function getOneData($id){
		$query=$this->db->query("select * from car_data where id =".$id);
		if ($query->num_rows() == 1) {
			$a=$query->result();
			return $a;
			} else {
			return false;
			}
	}

	//update car

	function updateCar($data,$id)
	{
		$this->db->where('id',$id);
		return $this->db->update('car_data',$data);
	}

	//delete car
	public function delete_item($id)
    {
        return $this->db->delete('car_data', array('id' => $id));
    }

	public function countRow(){
		$list =$this->db->from("car_data")->count_all_results();
		return $list;
		}

	public function countbook(){
		$book =$this->db->from("car_book")->count_all_results();
		return $book;
		}
	public function countcontact(){
		$contact =$this->db->from("contact")->count_all_results();
		return $contact;
		}
}

?>