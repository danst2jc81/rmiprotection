<?php
	class ContentEvent_model extends CI_Model {
		var $table = "content_event";
		
		public function ContentEvent_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 

		public function getContentEvent($start_date, $end_date)
		{
			$this->db->select('content_event.event_id, content_event.event_title, content_event.event_date, content_event.event_description, content_event.event_image');
			$this->db->from('content_event');
			$this->db->where('content_event.data_state', 0);

			if ($start_date != '1970-01-01'){
				$this->db->where('content_event.event_date >=', $start_date);
			}

			if ($end_date != '1970-01-01'){
				$this->db->where('content_event.event_date <=', $end_date);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEventToken($event_token){
			$this->db->select('content_event.event_token');
			$this->db->from('content_event');
			$this->db->where('content_event.event_token', $event_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertContentEvent($data){
			return $this->db->insert('content_event',$data);
		}

		public function getEventID(){
			$this->db->select('content_event.event_id');
			$this->db->from('content_event');
			$this->db->order_by('content_event.event_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['event_id'];
		}

		public function getContentEvent_Detail($event_id){
			$this->db->select('content_event.event_id, content_event.event_title, content_event.event_description, content_event.event_date, content_event.event_image, content_event.event_status');
			$this->db->from('content_event');
			$this->db->where('content_event.event_id', $event_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateContentEvent($data){
			$this->db->where('content_event.event_id', $data['event_id']);
			$query = $this->db->update('content_event', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteContentEvent($data){
			$this->db->where("content_event.event_id", $data['event_id']);
			$query = $this->db->update('content_event', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>