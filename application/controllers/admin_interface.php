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
	public function insertNews(){
		$this->load->view("admin_interface/insert-news",array('content'=>'','title'=>'','date'=>date("d.m.Y")));
	}
	/***********************************************************************************************************/
}