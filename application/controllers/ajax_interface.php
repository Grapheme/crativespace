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
	public function insertNews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$insert = $this->input->post();
		if($insert):
			$this->load->model('news');
			$insert['date'] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$insert['date']);
			$news_id = $this->news->insert_record($insert);
			if($news_id):
				$this->session->set_userdata('current_item',$news_id);
				if(isset($insert['publish'])):
					$this->news->update_field($news_id,'publish',1,'news');
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Новость добавлена<hr/>';
				$text .= '<ul><li><a id="load-images" href="#">Добавить изображения к созданной новости</a>';
				if($news_id):
					$text .= '<li><a href="'.site_url('administrator/news/edit/'.$news_id).'">Редактировать созданную новость</a></li>';
					$text .= '<li><a href="'.site_url('news').'" target="_blank">Просмотреть созданную новость</a></li>';
				endif;
				$text .= '<li><a href="'.site_url('administrator/news').'">К списку новостей</a></li></ul>';
				echo $text;
			endif;
		endif;
	}
	
	public function updateNews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$update = $this->input->post();
		if($update && $this->session->userdata('current_item')):
			$this->load->model('news');
			$update['date'] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$update['date']);
			$update['id'] = $this->session->userdata('current_item');
			$this->news->update_record($update);
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Новость сохранена<hr/>';
			$text .= '<ul><li><a href="'.site_url('administrator/news/edit/images/'.$update['id']).'">Управлять изображеними к текущей новости</a>';
			$text .= '<li><a href="'.site_url('news').'" target="_blank">Просмотреть созданную новость</a></li>';
			$text .= '<li><a href="'.site_url('administrator/news').'">К списку новостей</a></li></ul>';
			echo $text;
			$this->session->unset_userdata('current_item');
		else:
			$text = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при сохранении<hr/>';
		endif;
	}
	
	public function deleteNews(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$news = $this->input->post('parameter');
		$json_request = array('status'=>FALSE,'message'=>'');
		if($news):
			$this->load->model('news_images');
			$images = $this->news_images->photoNews($news);
			for($i=0;$i<count($images);$i++):
				$this->filedelete(getcwd().'/'.$images[$i]['src']);
			endfor;
			$this->news_images->delete_records($news,'news_images');
			$this->load->model('news');
			$this->news->delete_record($news,'news');
			$json_request['status'] = TRUE;
			$json_request['message'] = '<img src="'.site_url('img/check.png').'" alt="" /> Новость удалена';
		else:
			$json_request['message'] = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при удалении<hr/>';
		endif;
		echo json_encode($json_request);
	}
	
	public function saveNewsPhoto(){
		
		$this->load->model('news_images');
		$randomNumber = mt_rand(1,1000);
		$insert = array('news'=>0,'src'=>'');
		$insert['news'] = $this->session->userdata('current_item');
		if(!$insert['news']):
			show_error('Missing data');
		endif;
		$fn = (isset($_SERVER['HTTP_X_FILENAME'])?$_SERVER['HTTP_X_FILENAME']:false);
		if($fn):
			$newFileName = preg_replace('/.+(.)(\.)+/','news_'.$randomNumber."\$2",$fn);
			file_put_contents(getcwd().'/upload_images/'.$newFileName,file_get_contents('php://input'));
			echo "$fn uploaded";
			$insert['src'] = 'upload_images/'.$newFileName;
			$this->news_images->insert_record($insert);
			exit();
		else:
			if(isset($_FILES['fileselect'])):
				$files = $_FILES['fileselect'];
				$i = 0;
				foreach($files['error'] as $id => $err):
					if($err == UPLOAD_ERR_OK):
						$fn = $files['name'][$id];
						$newFileName = preg_replace('/.+(.)(\.)+/','property_'.$randomNumber."\$2",$fn);
						move_uploaded_file($files['tmp_name'][$id],getcwd().'/upload_images/'.$newFileName);
						$insert['src'] = 'upload_images/'.$newFileName;
						$this->news_images->insert_record($insert);
						echo "<p>File $fn uploaded.</p>";
						$i++;
					endif;
				endforeach;
			else:
				show_404();
			endif;
		endif;
	}
	
	public function deleteNewsPhoto(){
		
		if(!$this->input->is_ajax_request()):
			show_error('Аccess denied');
		endif;
		$json_request = array('status'=>FALSE,'message'=>'');
		$data = trim($this->input->post('postdata'));
		if($data):
			$data = preg_split("/&/",$data);
			for($i=0;$i<count($data);$i++):
				$dataid = preg_split("/=/",$data[$i]);
				$dataval[$i] = trim($dataid[1]);
			endfor;
			if($dataval):
				$this->load->model('news_images');
				for($i=0;$i<count($dataval);$i++):
					$image = $this->news_images->read_record($dataval[$i],'news_images');
					$this->filedelete(getcwd().'/'.$image['src']);
					$this->news_images->delete_record($image['id'],'news_images');
				endfor;
				$json_request['status'] = TRUE;
				$json_request['message'] = "Изображений удалено: ".count($dataval);
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