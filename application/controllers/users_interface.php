<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		
		if($this->loginstatus):

		endif;
	}
	
	public function index(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/index",$pagevar);
	}
	
	public function events(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/events",$pagevar);
	}
	
	public function projects(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/projects",$pagevar);
	}
	
	public function objectPartners(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/object-partners",$pagevar);
	}
	
	public function objectPhotos(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/object-photos",$pagevar);
	}
	
	public function objectProject(){
		
		$pagevar = array(

		);
		$this->load->view("users_interface/object-project",$pagevar);
	}
	
	public function people(){
		
		$pagevar = array(

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
		
		$this->session->unset_userdata(array('logon'=>'','userid'=>'','backpath'=>''));
		$this->session->set_userdata('current_language',$this->language);
		$this->load->model('currentdialogs');
		$this->currentdialogs->clear_history($this->user['uid']);
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('');
		endif;
	}
	
	/********************************************************************************************************************/
}