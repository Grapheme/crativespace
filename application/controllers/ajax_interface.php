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
		$user_email = trim(strtolower($this->input->post('login')));
		$email_password = trim($this->input->post('password'));
		if($user_email || $email_password):
			$this->load->model('users');
			$user = $this->users->auth_user($user_email,$email_password);
			if($user):
				$json_request['status'] = TRUE;
				$this->session->set_userdata(array('logon'=>md5($user_email),'userid'=>$user['id']));
				$json_request['cabinet_path'] = ADM_START_PAGE;
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
	
	/************************************************* news ************************************************************/
	public function saveNews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$insert = $this->input->post();
		if($insert):
			$this->load->model('news');
			$insert['date'] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$insert['date']);
			$news_id = $this->news->insert_record($insert);
			if($news_id):
				if(isset($insert['publish'])):
					$this->news->update_field($news_id,'publish',1,'news');
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Новость добавлена<hr/>';
				$text .= '<ul><li><a id="load-images" href="#">Добавить изображения к созданной новости</a>';
				if($news_id):
					$text .= '<li><a href="'.site_url('administrator/news/edit/'.$news_id).'">Редактировать созданную новость</a></li>';
					$text .= '<li><a href="'.site_url('news').'" target="_blank">Читать созданную новость</a></li>';
				endif;
				$text .= '<li><a href="'.site_url('administrator/news').'">К списку новостей</a></li></ul>';
				echo $text;
			endif;
		endif;
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
	
	public function profileSave(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$update = $this->input->post();
		if($update):
			$update['id'] = $this->user['uid'];
			$this->load->model('users');
			if(!empty($update['password']) && ($update['password'] == $update['confirm'])):
				$this->users->update_field($this->user['uid'],'password',md5($update['password']),'users');
			endif;
			echo '<img src="'.site_url('img/check.png').'" alt="" /> Профиль сохранен';
		endif;
	}

}