<?php
	Class HomePage_model extends CI_Model{
		
		public function HomePage_model(){
			parent::__construct();
			$this->CI = get_instance();
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
			$hasil = $this->db->query("SELECT distinct(SUBSTR(id_menu,1,1)) as detect from system_menu_mapping where user_group_level = '$level'");
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
		
		public function getContentBanner(){
			$this->db->select('content_banner.banner_id, content_banner.banner_title, content_banner.banner_headline, content_banner.banner_image, content_banner.banner_button, content_banner.banner_link');
			$this->db->from('content_banner');
			$this->db->where('content_banner.banner_status', 1);
			$this->db->where('content_banner.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getContentAboutUs(){
			$this->db->select('content_aboutus.aboutus_id, content_aboutus.aboutus_title, content_aboutus.aboutus_content, content_aboutus.aboutus_image');
			$this->db->from('content_aboutus');
			$this->db->where('content_aboutus.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentAboutUsImage(){
			$this->db->select('content_aboutus_image.aboutus_image');
			$this->db->from('content_aboutus_image');
			$this->db->where('content_aboutus_image.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getContentActivityHome(){
			$this->db->select('content_activity_home.activity_home_id, content_activity_home.activity_home_title, content_activity_home.activity_home_subtitle, content_activity_home.activity_home_headline, content_activity_home.activity_home_highlight, content_activity_home.activity_home_subhighlight, content_activity_home.activity_home_image');
			$this->db->from('content_activity_home');
			$this->db->where('content_activity_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentActivity(){
			$this->db->select('content_activity.activity_id, content_activity.activity_name, content_activity.activity_date, content_activity.activity_description, content_activity.content_status');
			$this->db->from('content_activity');
			$this->db->where('content_activity.data_state', 0);
			$this->db->where('content_activity.content_published', 1);
			$this->db->order_by('content_activity.activity_id', 'DESC');
			$this->db->limit(4);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getActivityImage($activity_id){
			$this->db->select('content_activity_image.activity_image');
			$this->db->from('content_activity_image');
			$this->db->where('content_activity_image.data_state', 0);
			$this->db->where('content_activity_image.activity_id', $activity_id);
			$this->db->order_by('rand()');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['activity_image'];
		}

		public function getContentMagazineHome(){
			$this->db->select('content_magazine_home.magazine_home_id, content_magazine_home.magazine_home_title, content_magazine_home.magazine_home_subtitle, content_magazine_home.magazine_home_headline, content_magazine_home.magazine_home_highlight, content_magazine_home.magazine_home_subhighlight, content_magazine_home.magazine_home_image');
			$this->db->from('content_magazine_home');
			$this->db->where('content_magazine_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentMagazine(){
			$this->db->select('content_magazine.magazine_id, content_magazine.magazine_title, content_magazine.magazine_date, content_magazine.magazine_description, content_magazine.magazine_student_name, content_magazine.magazine_student_class, content_magazine.magazine_image, content_magazine.content_status');
			$this->db->from('content_magazine');
			$this->db->where('content_magazine.data_state', 0);
			$this->db->where('content_magazine.content_published', 1);
			$this->db->order_by('content_magazine.magazine_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentAcademicHome(){
			$this->db->select('content_academic_home.academic_home_id, content_academic_home.academic_home_title, content_academic_home.academic_home_subtitle, content_academic_home.academic_home_headline, content_academic_home.academic_home_highlight, content_academic_home.academic_home_subhighlight, content_academic_home.academic_home_image');
			$this->db->from('content_academic_home');
			$this->db->where('content_academic_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentAcademic(){
			$this->db->select('content_academic.academic_id, content_academic.academic_category_id, core_academic_category.academic_category_name, content_academic.academic_title, content_academic.academic_date, content_academic.academic_description, content_academic.academic_image, content_academic.content_status');
			$this->db->from('content_academic');
			$this->db->join('core_academic_category', 'content_academic.academic_category_id = core_academic_category.academic_category_id');
			$this->db->where('content_academic.data_state', 0);
			$this->db->where('content_academic.content_published', 1);
			$this->db->order_by('content_academic.academic_id', 'DESC');
			$this->db->limit(4);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getContentFacilityHome(){
			$this->db->select('content_facility_home.facility_home_id, content_facility_home.facility_home_title, content_facility_home.facility_home_subtitle, content_facility_home.facility_home_headline, content_facility_home.facility_home_highlight, content_facility_home.facility_home_subhighlight, content_facility_home.facility_home_image');
			$this->db->from('content_facility_home');
			$this->db->where('content_facility_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentFacilityImage(){
			$this->db->select('content_facility.facility_id, content_facility.facility_title, content_facility.facility_description, content_facility.facility_media, content_facility.content_status');
			$this->db->from('content_facility');
			$this->db->where('content_facility.data_state', 0);
			$this->db->where('content_facility.content_published', 1);
			$this->db->where('content_facility.facility_status', 1);
			$this->db->order_by('content_facility.facility_id', 'DESC');
			$this->db->limit(10);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getContentFacilityVideo(){
			$this->db->select('content_facility.facility_id, content_facility.facility_title, content_facility.facility_description, content_facility.facility_media, content_facility.content_status');
			$this->db->from('content_facility');
			$this->db->where('content_facility.data_state', 0);
			$this->db->where('content_facility.content_published', 1);
			$this->db->where('content_facility.facility_status', 2);
			$this->db->order_by('content_facility.facility_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getContentNewsHome(){
			$this->db->select('content_news_home.news_home_id, content_news_home.news_home_title, content_news_home.news_home_subtitle, content_news_home.news_home_headline, content_news_home.news_home_highlight, content_news_home.news_home_subhighlight, content_news_home.news_home_image');
			$this->db->from('content_news_home');
			$this->db->where('content_news_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentNews(){
			$this->db->select('content_news.news_id, content_news.news_category_id, core_news_category.news_category_name, content_news.news_title, content_news.news_date, content_news.news_description,  content_news.news_image, content_news.content_status');
			$this->db->from('content_news');
			$this->db->join('core_news_category', 'content_news.news_category_id = core_news_category.news_category_id');
			$this->db->where('content_news.data_state', 0);
			$this->db->where('content_news.content_published', 1);
			$this->db->order_by('content_news.news_id', 'DESC');
			$this->db->limit(4);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getContentGalleryHome(){
			$this->db->select('content_gallery_home.gallery_home_id, content_gallery_home.gallery_home_title, content_gallery_home.gallery_home_subtitle, content_gallery_home.gallery_home_headline, content_gallery_home.gallery_home_highlight, content_gallery_home.gallery_home_subhighlight, content_gallery_home.gallery_home_image');
			$this->db->from('content_gallery_home');
			$this->db->where('content_gallery_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentGalleryImage(){
			$this->db->select('content_gallery.gallery_id, content_gallery.gallery_title, content_gallery.gallery_description, content_gallery.gallery_media, content_gallery.content_status');
			$this->db->from('content_gallery');
			$this->db->where('content_gallery.data_state', 0);
			$this->db->where('content_gallery.content_published', 1);
			$this->db->where('content_gallery.gallery_status', 1);
			$this->db->order_by('content_gallery.gallery_id', 'DESC');
			$this->db->limit(12);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getContentGalleryVideo(){
			$this->db->select('content_gallery.gallery_id, content_gallery.gallery_title, content_gallery.gallery_description, content_gallery.gallery_media, content_gallery.content_status');
			$this->db->from('content_gallery');
			$this->db->where('content_gallery.data_state', 0);
			$this->db->where('content_gallery.content_published', 1);
			$this->db->where('content_gallery.gallery_status', 2);
			$this->db->order_by('content_gallery.gallery_id', 'DESC');
			$this->db->limit(2);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getContentJournalHome(){
			$this->db->select('content_journal_home.journal_home_id, content_journal_home.journal_home_title, content_journal_home.journal_home_subtitle, content_journal_home.journal_home_headline, content_journal_home.journal_home_highlight, content_journal_home.journal_home_subhighlight, content_journal_home.journal_home_image');
			$this->db->from('content_journal_home');
			$this->db->where('content_journal_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		/* public function getContentJournal(){
			$this->db->select('content_journal.journal_id, content_journal.journal_category_id, core_journal_category.journal_category_name, content_journal.journal_title, content_journal.journal_date, content_journal.journal_description,  content_journal.journal_image, content_journal.content_status');
			$this->db->from('content_journal');
			$this->db->join('core_journal_category', 'content_journal.journal_category_id = core_journal_category.journal_category_id');
			$this->db->where('content_journal.data_state', 0);
			$this->db->where('content_journal.content_published', 1);
			$this->db->order_by('content_journal.journal_id', 'DESC');
			$this->db->limit(4);
			$result = $this->db->get()->result_array();
			return $result;
		} */

		public function getContentAlumniHome(){
			$this->db->select('content_alumni_home.alumni_home_id, content_alumni_home.alumni_home_title, content_alumni_home.alumni_home_subtitle, content_alumni_home.alumni_home_headline, content_alumni_home.alumni_home_highlight, content_alumni_home.alumni_home_subhighlight, content_alumni_home.alumni_home_image');
			$this->db->from('content_alumni_home');
			$this->db->where('content_alumni_home.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getContentAlumni(){
			$this->db->select('content_alumni.alumni_id, content_alumni.alumni_category_id, core_alumni_category.alumni_category_name, content_alumni.alumni_title, content_alumni.alumni_date, content_alumni.alumni_description,  content_alumni.alumni_image, content_alumni.content_status');
			$this->db->from('content_alumni');
			$this->db->join('core_alumni_category', 'content_alumni.alumni_category_id = core_alumni_category.alumni_category_id');
			$this->db->where('content_alumni.data_state', 0);
			$this->db->where('content_alumni.content_published', 1);
			$this->db->order_by('content_alumni.alumni_id', 'DESC');
			$this->db->limit(4);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPreferenceCompany(){
			$this->db->select('preference_company.company_id, preference_company.company_name, preference_company.company_address, preference_company.company_phone, preference_company.company_email, preference_company.company_headline, preference_company.company_logo_dark, preference_company.company_logo_light, preference_company.company_image, preference_company.company_longitude, preference_company.company_latitude, preference_company.company_facebook, preference_company.company_instagram, preference_company.company_whatsapp');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result;
		}
	}
?>