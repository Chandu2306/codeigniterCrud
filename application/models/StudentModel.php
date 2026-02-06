<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {
	
	public function add($data){
		return $this->db->insert('students',$data);
	}

	public function show(){
		return $this->db->get('students')->result();
	}

	public function showStudent($id){
		return  $this->db->get_where('students',array('id'=>$id))->row();
	}

	public  function delete($id){
		return $this->db->delete('students',array('id'=>$id));
	}

	public function update($id,$data){
		return $this->db->where('id',$id)->update('students',$data);
	}
	
		public function contactUs($data){
		return $this->db->insert('queries',$data);
	}

	public function getStudentByRollNo($roll_no){
		return $this->db->get_where('students',array('roll_no'=>$roll_no))->row();
	}

	public function getStudentByContact($contact)
{
    return $this->db->get_where('students', array('contact'=>$contact))->row();
}


}

/* End of file StudentModel.php */
/* Location: ./application/models/StudentModel.php */
?>