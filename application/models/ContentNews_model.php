<?php
	class ContentNews_model extends CI_Model {
		var $table = "content_news";
		
		public function ContentNews_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 

		public function getContentNews($start_date, $end_date)
		{
			$this->db->select('content_news.news_id, content_news.news_title, content_news.news_date, content_news.news_description, content_news.news_image');
			$this->db->from('content_news');
			$this->db->where('content_news.data_state', 0);

			if ($start_date != '1970-01-01'){
				$this->db->where('content_news.news_date >=', $start_date);
			}

			if ($end_date != '1970-01-01'){
				$this->db->where('content_news.news_date <=', $end_date);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getNewsToken($news_token){
			$this->db->select('content_news.news_token');
			$this->db->from('content_news');
			$this->db->where('content_news.news_token', $news_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertContentNews($data){
			return $this->db->insert('content_news',$data);
		}

		public function getNewsID(){
			$this->db->select('content_news.news_id');
			$this->db->from('content_news');
			$this->db->order_by('content_news.news_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['news_id'];
		}

		public function getContentNews_Detail($news_id){
			$this->db->select('content_news.news_id, content_news.news_title, content_news.news_description, content_news.news_date, content_news.news_image, content_news.news_status');
			$this->db->from('content_news');
			$this->db->where('content_news.news_id', $news_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateContentNews($data){
			$this->db->where('content_news.news_id', $data['news_id']);
			$query = $this->db->update('content_news', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteContentNews($data){
			$this->db->where("content_news.news_id", $data['news_id']);
			$query = $this->db->update('content_news', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>