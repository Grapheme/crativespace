<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
	}
	
	/******************************************** guests interface *******************************************************/
	public function login_in(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'message'=>'Ошибка авторизации','cabinet_path'=>base_url());
		$user_email = trim(strtolower($this->input->post('user_email')));
		$email_password = trim($this->input->post('email_password'));
		if($user_email || $email_password):
			$user = $this->users->auth_user($user_email,$email_password);
			if($user):
				if($user['active']):
					$json_request['status'] = TRUE;
					$this->session->set_userdata(array('logon'=>md5($user_email),'userid'=>$user['id']));
					$this->load->model('currentdialogs');
					$this->currentdialogs->clear_history($user['id']);
					switch($user['class']):
						case 1: $json_request['cabinet_path'] .= ADM_START_PAGE;
							break;
						case 2: $json_request['cabinet_path'] .= UNIVERSITY_START_PAGE;
							break;
						case 3: $json_request['cabinet_path'] .= TEACHER_START_PAGE;
							break;
						case 4: $json_request['cabinet_path'] .= STUDENT_START_PAGE;
							break;
						case 5: $json_request['cabinet_path'] .= KEEPER_START_PAGE;
							break;
					endswitch;
				endif;
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	public function forgot_password(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'title'=>'<span class="label label-success">Успешно</span>','message'=>'На указанный адрес выслано письмо с дальнейшими указаниями.');
		$user_email = trim($this->input->post('user_email'));
		if($user_email):
			$user_id = $this->users->user_exist('email',trim($user_email));
			if($user_id):
				$new_password = $this->randomPassword(10);
				$result = $this->users->update_field($user_id,'password',md5($new_password),'users');
				if($result):
					$user = $this->users->read_record($user_id,'users');
					ob_start();?>
<p>Здравствуйте <em>ИМЯ</em>,</p><p>Текст письма</p><?
					$mailtext = ob_get_clean();
					$this->send_mail($user['email'],'robot@universiality.com','Universiality','Запрос на восстановления пароля',$mailtext);
					$json_request['status'] = TRUE;
				endif;
			else:
				$json_request['title'] = 'ОК';
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	public function register_student(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		print_r($this->session->userdata('current_language'));
		$json_request = array('status'=>FALSE,'message'=>'Ошибка при регистрации','cabinet_path'=>base_url().'student/register-successful');
		$data = trim($this->input->post('postdata'));
		if($data):
			$data = preg_split("/&/",$data);
			for($i=0;$i<count($data);$i++):
				$dataid = preg_split("/=/",$data[$i]);
				$dataval[$dataid[0]] = $dataid[1];
			endfor;
			if($this->users->record_exist('users','email',trim($dataval['email']))):
				$json_request['message'] = 'Email уже зерегистрирован';
			else:
				if($dataval && !$this->loginstatus):
					$this->load->model('students');
					$student_id = $this->students->insert_record($dataval);
					$user_id = $this->users->insert_record($dataval);
					if($user_id):
						$this->users->update_field($user_id,'user_id',$student_id,'users');
						$this->users->update_field($user_id,'class',4,'users');
						$this->users->update_field($user_id,'language',$this->language,'users');
						$this->load->helper('string');
						$activate_code = random_string('alnum',25);
						$this->users->update_field($user_id,'temporary_code',$activate_code,'users');
						$json_request['status'] = TRUE;
						$this->session->set_userdata('student_registering_flag',TRUE);
						ob_start();?>
						<p>Здравствуйте <em><?=$dataval['name'];?></em>,</p>
						<p>Спасибо за регистрацию в UNIVERSIALITY.<br/>Чтобы получить доступ к вашему аккаунту, пожалуйста, перейдите по одноразовой ссылке:<br/>
						<?=anchor('registering/student/activation-code/'.$activate_code,base_url().'registering/student/activation-code/'.$activate_code,array('target'=>'_blank'));?></p><?
						$mailtext = ob_get_clean();
						$this->send_mail($dataval['email'],'robot@universiality.ru','Universiality','Регистравция в UNIVERSIALITY',$mailtext);
					endif;
				endif;
			endif;
		endif;
		echo json_encode($json_request);
	}

	/*********************************************** profiles **********************************************************/
	public function saveProfileAvatar(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responseAvatarSrc'=>'','responsePhotoSrc'=>'');
		if($_FILES['photo']['error'] != 4):
			$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
			$photo = file_get_contents($_FILES['photo']['tmp_name']);
			$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,64,64);
			$thumbnail = file_get_contents($_FILES['photo']['tmp_name']);
			if($photo && $thumbnail):
				$this->users->update_field($this->user['uid'],'photo',$photo,'users');
				$this->users->update_field($this->user['uid'],'thumbnail',$thumbnail,'users');
				$this->load->helper('string');
				$json_request['responseAvatarSrc'] = site_url('loadimage/avatar/'.$this->user['uid'].'?'.random_string('alpha',5));
				$json_request['responsePhotoSrc'] = site_url('loadimage/photo/'.$this->user['uid'].'?'.random_string('alpha',5));
				$json_request['status'] = TRUE;
			endif;
		endif;
		if($json_request['status']):
			$json_request['responseText'] = 'Файл загружен';
		else:
			$json_request['responseText'] = 'Ошибка при загрузке';
		endif;
		echo json_encode($json_request);
	}
	
	public function accountSave(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$insert = $this->input->post();
		if($insert):
			$current_item = $this->session->userdata('current_item');
			if(!$current_item):
				echo '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при сохранении';
			else:
				$update = $this->input->post();
				if(isset($update['active'])):
					$this->users->update_field($current_item,'active',1,'users');
				endif;
				echo '<img src="'.site_url('img/check.png').'" alt="" /> Профиль сохранен';
			endif;
		endif;
	}

}