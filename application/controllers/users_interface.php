<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{
	
	var $per_page = 6;
	var $offset = 0;
	
	function __construct(){
		
		parent::__construct();
		
		if($this->loginstatus):

		endif;
	}
	
	public function index(){
		
		$this->load->helper('date');
		$this->load->helper('text');
		$this->load->model('events');
		$this->load->model('news');
		$this->load->model('news_images');
		
		$pagevar = array(
			'events' => $this->events->read_limit_records($this->per_page,$this->offset,'events','id','DESC'),
			'news' => $this->news->read_limit_records($this->per_page,$this->offset,'news','date_publish','DESC'),
			'next_items' => $this->news->exist_next_records($this->per_page+$this->offset+1,'news')
		);
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['photos'] = $this->news_images->photoNews($pagevar['news'][$i]['id']);
		endfor;
		$this->load->view("users_interface/index",$pagevar);
	}
	
	public function events(){
		
		$this->load->helper('date');
		$this->load->helper('text');
		$this->load->model('events');
		$pagevar = array(
			'events' => $this->events->read_limit_records($this->per_page,$this->offset,'events','id','DESC'),
			'next_items' => $this->events->exist_next_records($this->per_page+$this->offset+1,'events')
		);
		$this->load->view("users_interface/events",$pagevar);
	}
	
	public function projects(){
		
		$this->load->helper('text');
		$this->load->model('projects');
		$pagevar = array(
			'projects' => $this->projects->read_records('projects','title','ASC'),
		);
		$this->load->view("users_interface/projects",$pagevar);
	}
	
	public function objectPartners(){
		
		$this->load->helper('text');
		$this->load->model('partners');
		$pagevar = array(
			'partners' => $this->partners->read_records('partners','title','ASC'),
		);
		$this->load->view("users_interface/object-partners",$pagevar);
	}
	
	public function objectPhotos(){
		
		$this->load->model('object_images');
		$pagevar = array(
			'images' => $this->object_images->read_records('object_images','id','DESC'),
		);
		$this->load->view("users_interface/object-photos",$pagevar);
	}
	
	public function objectProject(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/object-project",$pagevar);
	}
	
	public function people(){
		
		$this->load->helper('text');
		$this->load->model('people');
		$pagevar = array(
			'people' => $this->people->read_records('people','name','ASC'),
		);
		$this->load->view("users_interface/people",$pagevar);
	}
	
	public function contacts(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/contacts",$pagevar);
	}
	
	
	/********************************************************************************************************************/
	public function logoff(){
		
		$this->session->sess_destroy();
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('');
		endif;
	}
	
	public function login(){
		
		if($this->loginstatus):
			redirect(ADM_START_PAGE);
		else:
			$this->load->view("users_interface/login");
		endif;
	}
	
	/********************************************************************************************************************/
}