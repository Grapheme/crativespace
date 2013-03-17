<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	var $countMessages;
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus):
			redirect('');
		endif;
	}
	
	/******************************************** cabinet *******************************************************/
	
	public function control_panel(){
		
		$pagevar = array(
		
		);
		$this->load->view("admin_interface/control-panel",$pagevar);
	}
	
	public function profile(){
		
		$this->load->view("admin_interface/profile");
	}
	
	/********************************************** news ********************************************************/
	
	public function listNews(){
		
		$this->load->helper('date');
		$this->load->helper('text');
		$this->load->model('news');
		$per_page = 7;
		$offset = intval($this->uri->segment(4));
		$pagevar = array(
			'news' => $this->news->read_limit_records($per_page,$offset,'news','date_publish','DESC'),
			'pagination' => $this->pagination('administrator/news',4,$this->news->count_all_records('news'),$per_page),
		);
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/news/news-list",$pagevar);
	}
	
	public function insertNews(){
		
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/news/insert-news",array('multi_upload_photos_url'=>'administrator/news/insert/images',));
	}

	public function editNews(){
		
		$current_item = $this->session->userdata('current_item');
		if(!$current_item && $this->uri->total_segments() == 4):
			$this->session->set_userdata('current_item',$this->uri->segment(4));
			redirect('administrator/news/edit');
		elseif(!$current_item && $this->uri->total_segments() == 3):
			redirect('administrator/news');
		endif;
		$this->load->helper('date');
		$this->load->model('news');
		$pagevar = array(
			'news' => $this->news->newsInformation($current_item),
		);
		$pagevar['news']['date_publish'] = swap_dot_date_without_time($pagevar['news']['date_publish']);
		if(!$pagevar['news']):
			show_error('В доступе отказано');
		endif;
		$this->load->view("admin_interface/news/update-news",$pagevar);
	}
	
	public function editNewsImages(){
		
		$current_item = $this->session->userdata('current_item');
		if(!$current_item && $this->uri->total_segments() == 5):
			$this->session->set_userdata('current_item',$this->uri->segment(5));
			redirect('administrator/news/edit/images');
		elseif(!$current_item && $this->uri->total_segments() == 4):
			redirect('administrator/news/edit');
		endif;
		$this->load->model('news_images');
		$pagevar = array(
			'images' => $this->news_images->photoNews($current_item),
			'multi_upload_photos_url' => 'administrator/news/insert/images',
			'multi_delete_photo_url' => 'administrator/news/images/delete'
		);
		$this->load->view("admin_interface/news/manage-news-images",$pagevar);
	}
	
	/********************************************** events ********************************************************/
	
	public function listEvents(){
		
		$this->load->helper('text');
		$this->load->model('events');
		$per_page = 7;
		$offset = intval($this->uri->segment(4));
		$pagevar = array(
			'events' => $this->events->read_limit_records($per_page,$offset,'events','id','DESC'),
			'pagination' => $this->pagination('administrator/events',4,$this->events->count_all_records('events'),$per_page),
		);
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/events/events-list",$pagevar);
	}
	
	public function insertEvent(){
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/events/insert-event");
	}

	public function editEvent(){
		$current_item = $this->session->userdata('current_item');
		if(!$current_item && $this->uri->total_segments() == 4):
			$this->session->set_userdata('current_item',$this->uri->segment(4));
			redirect('administrator/events/edit');
		elseif(!$current_item && $this->uri->total_segments() == 3):
			redirect('administrator/events');
		endif;
		$this->load->model('events');
		$pagevar = array(
			'event' => $this->events->eventInformation($current_item),
		);
		if(!$pagevar['event']):
			show_error('В доступе отказано');
		endif;
		$this->load->view("admin_interface/events/update-event",$pagevar);
	}
	
	/********************************************** projects ********************************************************/
	
	public function listProjects(){
		
		$this->load->helper('text');
		$this->load->model('projects');
		$per_page = 7;
		$offset = intval($this->uri->segment(4));
		$pagevar = array(
			'projects' => $this->projects->read_limit_records($per_page,$offset,'projects','id','DESC'),
			'pagination' => $this->pagination('administrator/projects',4,$this->projects->count_all_records('projects'),$per_page),
		);
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/projects/projects-list",$pagevar);
	}
	
	public function insertProject(){
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/projects/insert-project");
	}

	public function editProject(){
		$current_item = $this->session->userdata('current_item');
		if(!$current_item && $this->uri->total_segments() == 4):
			$this->session->set_userdata('current_item',$this->uri->segment(4));
			redirect('administrator/projects/edit');
		elseif(!$current_item && $this->uri->total_segments() == 3):
			redirect('administrator/projects');
		endif;
		$this->load->model('projects');
		$pagevar = array(
			'project' => $this->projects->projectInformation($current_item),
		);
		if(!$pagevar['project']):
			show_error('В доступе отказано');
		endif;
		$this->load->view("admin_interface/projects/update-project",$pagevar);
	}
	
	/********************************************** partners ********************************************************/
	
	public function listPartners(){
		
		$this->load->helper('text');
		$this->load->model('partners');
		$per_page = 7;
		$offset = intval($this->uri->segment(5));
		$pagevar = array(
			'partners' => $this->partners->read_limit_records($per_page,$offset,'partners','id','DESC'),
			'pagination' => $this->pagination('administrator/object/partners',5,$this->partners->count_all_records('partners'),$per_page),
		);
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/partners/partners-list",$pagevar);
	}
	
	public function insertPartner(){
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/partners/insert-partner");
	}

	public function editPartner(){
		$current_item = $this->session->userdata('current_item');
		if(!$current_item && $this->uri->total_segments() == 5):
			$this->session->set_userdata('current_item',$this->uri->segment(5));
			redirect('administrator/object/partners/edit');
		elseif(!$current_item && $this->uri->total_segments() == 4):
			redirect('administrator/object/partners');
		endif;
		$this->load->model('partners');
		$pagevar = array(
			'partner' => $this->partners->projectInformation($current_item),
		);
		if(!$pagevar['partner']):
			show_error('В доступе отказано');
		endif;
		$this->load->view("admin_interface/partners/update-partner",$pagevar);
	}
	
	/********************************************** photos ********************************************************/
	public function objectPhotos(){
		
		$this->load->model('object_images');
		$pagevar = array(
			'images' => $this->object_images->read_records('object_images','id','DESC'),
			'multi_upload_photos_url' => 'administrator/object/insert/images',
			'multi_delete_photo_url' => 'administrator/object/images/delete',
			'multi_title_photos_url' => 'administrator/object/images/title/save'
		);
		$this->load->view("admin_interface/photos",$pagevar);
	}
	
	/********************************************** people ********************************************************/
	public function listPeople(){
		
		$this->load->helper('text');
		$this->load->model('people');
		$per_page = 7;
		$offset = intval($this->uri->segment(5));
		$pagevar = array(
			'people' => $this->people->read_limit_records($per_page,$offset,'people','id','DESC'),
			'pagination' => $this->pagination('administrator/people',5,$this->people->count_all_records('people'),$per_page),
		);
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/people/people-list",$pagevar);
	}
	
	public function insertPeople(){
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/people/insert-people");
	}

	public function editPeople(){
		$current_item = $this->session->userdata('current_item');
		if(!$current_item && $this->uri->total_segments() == 4):
			$this->session->set_userdata('current_item',$this->uri->segment(4));
			redirect('administrator/people/edit');
		elseif(!$current_item && $this->uri->total_segments() == 3):
			redirect('administrator/people');
		endif;
		$this->load->model('people');
		$pagevar = array(
			'people' => $this->people->projectInformation($current_item),
		);
		if(!$pagevar['people']):
			show_error('В доступе отказано');
		endif;
		$this->load->view("admin_interface/people/update-people",$pagevar);
	}
	/***********************************************************************************************************/
}