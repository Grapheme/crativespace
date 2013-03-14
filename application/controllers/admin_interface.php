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
			'pagination' => $this->pagination('administrator/news',4,$this->news->counNews(),$per_page),
		);
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/news-list",$pagevar);
	}
	
	public function insertNews(){
		$this->session->unset_userdata('current_item');
		$this->load->view("admin_interface/insert-news");
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
		$this->load->view("admin_interface/update-news",$pagevar);
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
		);
		$this->load->view("admin_interface/manage-news-images",$pagevar);
	}

	/***********************************************************************************************************/
}