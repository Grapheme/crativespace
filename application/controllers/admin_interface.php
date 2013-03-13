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
		
		$this->load->model('teachers');
		$this->load->model('students');
		$pagevar = array(
			'count_users' => array('teachers'=>$this->teachers->count_all_records('teachers'),'students'=>$this->students->count_all_records('students')),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata(array('msgr'=>'','msgs'=>''));
		$this->load->view("admin_interface/cabinet/control-panel",$pagevar);
	}
	
	public function profile(){
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('language',' ','required|trim');
			$this->form_validation->set_rules('password',' ','trim');
			$this->form_validation->set_rules('confirm',' ','matches[password]|trim');
			if($this->form_validation->run()):
				$update = $this->input->post();
				$msgs = 'Профиль сохранен.';
				if($_FILES['photo']['error'] != 4):
					$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
					$update['photo'] = file_get_contents($_FILES['photo']['tmp_name']);
					$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,64,64);
					$update['thumbnail'] = file_get_contents($_FILES['photo']['tmp_name']);
				endif;
				$update['id'] = $this->user['uid'];
				$this->users->update_record($update);
				if(!empty($update['password'])):
					$this->users->update_field($this->user['uid'],'password',md5($update['password']),'users');
					$msgs .= ' Пароль изменен.';
				endif;
				$this->session->set_userdata('msgs',$msgs);
				redirect($this->uri->uri_string());
			else:
				$this->session->set_userdata('msgr','Ошибка при заполнении полей');
			endif;
		endif;
		$pagevar = array(
			'languages' => $this->manual_languages->visible_languages(),
			'profile' => $this->users->read_record($this->user['uid'],'users'),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata(array('msgr'=>'','msgs'=>''));
		$this->load->view("admin_interface/cabinet/profile",$pagevar);
	}
	
	/***********************************************************************************************************/
}