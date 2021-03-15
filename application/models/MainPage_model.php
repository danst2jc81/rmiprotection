<?php
	Class MainPage_model extends CI_Model{
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getMenuMapping($user_group_level, $id){
			$this->db->select('system_menu_mapping.id_menu');
			$this->db->from('system_menu_mapping');
			$this->db->join('system_menu', 'system_menu_mapping.id_menu = system_menu.id_menu');
			$this->db->where('system_menu_mapping.user_group_level', $user_group_level);
			$this->db->where('system_menu.id', $id);
			$this->db->limit(1);
			return $this->db->get()->row_array();
		}
		
		public function getMenu($level){
			$this->db->select('m.id_menu,m.id,m.type,m.text,m.image')->from('system_menu as m');
			// $this->db->join('system_menu_mapping as mm', 'mm.id_menu=m.id_menu');
			// $this->db->where('mm.user_group_level',$level);
			$this->db->where('m.type','folder');
			$this->db->or_where('m.type','file');
			$this->db->order_by('m.id_menu','asc');
			$result = $this->db->get()->result_array();
			// print_r($result); exit;
			return $result;
		}
		
		public function getMenu2($level){
			$hasil = $this->db->query("select * from system_menu as m where id_menu in (select DISTINCT(SUBSTR(m.id_menu,1,1)) as id_menu from system_menu as m
			join system_menu_mapping as mm on mm.id_menu=m.id_menu
			where mm.user_group_level='$level' and m.type in ('folder','file'))");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getDataParentmenu($id){
			$hasil = $this->db->query("select * from system_menu WHERE id_menu='$id' and type in ('folder','file')");
			$hasil = $hasil->row_array();
			return $hasil;
		}
		
		public function getParentMenu($level){
			$hasil = $this->db->query("SELECT distinct(SUBSTR(id_menu,1,1)) as detect from system_menu_mapping where user_group_level='$level'");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getDataMenu($id){
		// print_r($id); exit;
			$this->db->select('m.id_menu,m.id,m.type,m.text,m.image')->from('system_menu as m');
			$this->db->where('m.id',$id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getDataMenu2($id){
		// print_r($id); exit;
			$this->db->select('m.id_menu,m.id,m.type,m.text,m.image')->from('system_menu_not_direct as m');
			$this->db->where('m.id',$id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getDataFolder($id){
			$this->db->select('m.id_menu,m.id,m.type,m.text,m.image')->from('system_menu as m');
			$this->db->where('m.id_menu',$id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getFolder($id){
			$this->db->select('m.id_menu,m.id,m.type,m.text,m.image')->from('system_menu as m');
			$this->db->where('m.id_menu',$id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getIDMenu($class){
			$hasil = $this->db->query("SELECT id_menu from system_menu where id = '$class'");
			$hasil = $hasil->row_array();
			return $hasil['id_menu'];
		}
		
		public function getID($class){
			$hasil = $this->db->query("SELECT id from system_menu where id_menu= '$class'");
			$hasil = $hasil->row_array();
			return $hasil['id'];
		}
		
		public function getSameFolder($level,$index){
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,2) as detect from system_menu_mapping where user_group_level='$level' And id_menu like '$index%' and type in ('folder','file')");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getActive($class){			
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,1) as detect from system_menu where id like '".$class."%'");			
			$hasil = $hasil->row_array();			
			if(count($hasil)>0){					
				return $hasil['detect'];			
			}else{			
				return 0;		
			}		
		}		
		
		public function getParentSubMenu($level, $index){
			$hasil = $this->db->query("SELECT b.* from system_menu_mapping as a, system_menu as b where user_group_level='$level' and a.id_menu=b.id_menu and a.id_menu like '$index%' and type in ('folder','file')");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getParentSubMenu2($level, $index){			
			$hasil = $this->db->query("select DISTINCT(substr(t.id_menu,1,2)) as id_menu from (SELECT b.id_menu, b.id, b.type, b.text, b.image from system_menu_mapping as a, system_menu as b where user_group_level='$level' and a.id_menu=b.id_menu and a.id_menu like '$index%' and type in ('folder','file')) as t");		
			$hasil = $hasil->result_array();			
			return $hasil;	
		}				
		
		public function getParentSubMenu3($level, $index){			
			$hasil = $this->db->query("select DISTINCT(substr(t.id_menu,1,3)) as id_menu from (SELECT b.id_menu, b.id, b.type, b.text, b.image from system_menu_mapping as a, system_menu as b where user_group_level='$level' and a.id_menu=b.id_menu and a.id_menu like '$index%' and type in ('folder','file')) as t");			
			$hasil = $hasil->result_array();			
			return $hasil;		
		}	

		public function getParentSubMenu4($level, $index){			
			$hasil = $this->db->query("select DISTINCT(substr(t.id_menu,1,4)) as id_menu from (SELECT b.id_menu, b.id, b.type, b.text, b.image from system_menu_mapping as a, system_menu as b where user_group_level='$level' and a.id_menu=b.id_menu and a.id_menu like '$index%' and type in ('folder','file')) as t");
			$hasil = $hasil->result_array();		
			return $hasil;		
		}				
		
		public function getActive2($class){			
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,2) as detect from system_menu where id='".$class."'");			
			$hasil = $hasil->row_array();	
			/*print_r($this->db->last_query());
			print_r("<BR>");	*/	
			if(count($hasil)>0){					
				return $hasil['detect'];			
			}else{				
				return 0;		
			}	
		}		
		
		public function getActive3($class){			
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,3) as detect from system_menu where id='".$class."'");		
			$hasil = $hasil->row_array();			
			if(count($hasil)>0){				
				return $hasil['detect'];			
			}else{				
				return 0;		
			}		
		}
	
		public function getSubMenu($level,$id){			$hasil = $this->db->query("select id_menu,id,type,text,image from system_menu where id_menu like '$id%' and type='file'");			$hasil = $hasil->result_array();			return $hasil;		}		
		
		public function getSubMenu2($level){
			$hasil = $this->db->query("select id_menu from system_menu where id_menu like '$level%' and type in ('folder','file')");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getLastActivity($user){
			$hasil = $this->db->query("SELECT log_time from system_log_user where username='$user' And id_previllage='1002' Order By log_time DESC LIMIT 0,1");
			$hasil = $hasil->row_array();
			if(count($hasil)>0){
				return $hasil['log_time'];
			}else{
				return '0000-00-00 00:00:00';
			}
		}
		
		public function getAva($username){
			$this->db->select('avatar')->from('system_user');
			$this->db->where('username',$username);
			$result = $this->db->get()->row_array();
			return $result['avatar'];
		}

		public function gettext($id){
			$this->db->select('text')->from('system_menu');
			$this->db->where('id',$id);
			$result = $this->db->get()->row_array();
			if(isset($result['text'])){
				$hasil = $result['text'];
			} else {
				$hasil = 'Not Define';
			}
			return $hasil;
		}

		public function getSalesInvoice($date){
			$this->db->select('SUM(sales_invoice.total_amount) AS total_sales_invoice');
			$this->db->from('sales_invoice');
			$this->db->where('sales_invoice.sales_invoice_date', $date);
			$this->db->where('sales_invoice.data_state', '0');
			$result = $this->db->get()->row_array();
			return $result['total_sales_invoice'];
		}

		public function getInvtItem($date){
			$this->db->select('sales_invoice_item.item_id');
			$this->db->from('sales_invoice_item');
			$this->db->join('sales_invoice', 'sales_invoice_item.sales_invoice_id = sales_invoice.sales_invoice_id');
			$this->db->where('sales_invoice.sales_invoice_date', $date);
			$this->db->where('sales_invoice.data_state', '0');
			$this->db->group_by('sales_invoice_item.item_id');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSalesInvoiceItem($month, $year){
			$this->db->select('sales_invoice_item.item_id, invt_item.item_name, SUM(sales_invoice_item.quantity) AS total_quantity');
			$this->db->from('sales_invoice_item');
			$this->db->join('sales_invoice', 'sales_invoice_item.sales_invoice_id = sales_invoice.sales_invoice_id');
			$this->db->join('invt_item', 'sales_invoice_item.item_id = invt_item.item_id');
			$this->db->where('MONTH(sales_invoice.sales_invoice_date)', $month);
			$this->db->where('YEAR(sales_invoice.sales_invoice_date)', $year);
			$this->db->where('sales_invoice.data_state', '0');
			$this->db->where('invt_item.item_packing', '0');
			$this->db->order_by('total_quantity', 'DESC');
			$this->db->group_by('sales_invoice_item.item_id');
			$this->db->limit(10);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSalesInvoiceWeekly($date){
			$this->db->select('SUM(sales_invoice.total_amount) AS total_sales_invoice');
			$this->db->from('sales_invoice');
			$this->db->where('sales_invoice.sales_invoice_date', $date);
			$this->db->where('sales_invoice.data_state', '0');
			$result = $this->db->get()->row_array();
			return $result['total_sales_invoice'];
		}
	}
?>