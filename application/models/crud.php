<?php
	class Crud extends CI_Model{

		public function getRecords(){
		$query = $this->db->get('crud');///to get all data
		return $query->result();

		}

		public function saveRecord($data){
			return $this->db->insert('crud', $data);

		}


		public function deleteRecord($record_id){
			return $this->db->delete('crud', array('id' => $record_id));

		}


			///get all data to make edit
			public function getAllRecords($record_id){
			$query = $this->db->get_where('crud', array('id' => $record_id));
			if ($query->num_rows() > 0) {
				return $query->row();
			}

		}
			//update
		public function updateRecord($record_id,$data){
			return $this->db->where('id', $record_id)->update('crud', $data);
		}



	


	}

 ?>