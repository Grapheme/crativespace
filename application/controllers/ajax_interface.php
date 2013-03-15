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
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Новость сохранена<hr/>';
			$text .= '<ul><li><a href="'.site_url('administrator/news/edit/images/'.$update['id']).'">Управлять изображеними к текущей новости</a>';
			$text .= '<li><a href="'.site_url('news').'" target="_blank">Просмотреть новость</a></li>';
			$text .= '<li><a href="'.site_url('administrator/news').'">К списку новостей</a></li></ul>';
			echo $text;
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
			echo "$fn загружен";
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
						echo "<p>Файл $fn загружен.</p>";
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

	/************************************************* events ************************************************************/
	public function insertEvent(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$insert = $this->input->post();
		if($insert):
			$this->load->model('events');
			$insert['date'] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$insert['date']);
			$event_id = $this->events->insert_record($insert);
			if($event_id):
				if(isset($_FILES['photo'])):
					if($_FILES['photo']['error'] != 4):
						$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->events->update_field($event_id,'photo',$photo,'events');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Мероприятие добавлено<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/events/add').'">Добавить мероприятие</a>';
				if($event_id):
					$text .= '<li><a href="'.site_url('administrator/events/edit/'.$event_id).'">Редактировать созданное мероприятие</a></li>';
					$text .= '<li><a href="'.site_url('events').'" target="_blank">Просмотреть созданное мероприятие</a></li>';
				endif;
				$text .= '<li><a href="'.site_url('administrator/events').'">К списку мероприятий</a></li></ul>';
				echo $text;
			endif;
		endif;
	}
	
	public function updateEvent(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$update = $this->input->post();
		if($update && $this->session->userdata('current_item')):
			$this->load->model('events');
			$update['date'] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$update['date']);
			$update['id'] = $this->session->userdata('current_item');
			$this->events->update_record($update);
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Мероприятие сохранено<hr/>';
			$text .= '<li><a href="'.site_url('events').'" target="_blank">Просмотреть мероприятие</a></li>';
			$text .= '<li><a href="'.site_url('administrator/events').'">К списку меропритий</a></li></ul>';
			echo $text;
		else:
			$text = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при сохранении<hr/>';
		endif;
	}
	
	public function deleteEvent(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$event = $this->input->post('parameter');
		$json_request = array('status'=>FALSE,'message'=>'');
		if($event):
			$this->load->model('events');
			$this->events->delete_record($event,'events');
			$json_request['status'] = TRUE;
			$json_request['message'] = '<img src="'.site_url('img/check.png').'" alt="" /> Мероприятие удалено';
		else:
			$json_request['message'] = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при удалении<hr/>';
		endif;
		echo json_encode($json_request);
	}
	
	public function updateEventPhoto(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		if($_FILES['photo']['error'] != 4):
			$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
			$photo = file_get_contents($_FILES['photo']['tmp_name']);
			if($photo):
				$this->load->model('events');
				$event_id = $this->session->userdata('current_item');
				if($event_id):
					$this->events->update_field($event_id,'photo',$photo,'events');
					$this->load->helper('string');
					$json_request['responsePhotoSrc'] = site_url('loadimage/events/'.$event_id.'?'.random_string('alpha',5));
					$json_request['status'] = TRUE;
				endif;
			endif;
		endif;
		if($json_request['status']):
			$json_request['responseText'] = 'Файл загружен';
		else:
			$json_request['responseText'] = 'Ошибка при загрузке';
		endif;
		echo json_encode($json_request);
	}
	
	/************************************************* projects ************************************************************/
	public function insertProject(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$insert = $this->input->post();
		if($insert):
			$this->load->model('projects');
			$insert['translit'] = $this->translite($insert['title']);
			$project_id = $this->projects->insert_record($insert);
			if($project_id):
				if(isset($_FILES['photo'])):
					if($_FILES['photo']['error'] != 4):
						$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->projects->update_field($project_id,'photo',$photo,'projects');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Проект добавлен<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/projects/add').'">Добавить проект</a>';
				if($project_id):
					$text .= '<li><a href="'.site_url('administrator/projects/edit/'.$project_id).'">Редактировать созданный проект</a></li>';
					$text .= '<li><a href="'.site_url('projects').'" target="_blank">Просмотреть проекты</a></li>';
				endif;
				$text .= '<li><a href="'.site_url('administrator/projects').'">К списку проектов</a></li></ul>';
				echo $text;
			endif;
		endif;
	}
	
	public function updateProject(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$update = $this->input->post();
		if($update && $this->session->userdata('current_item')):
			$this->load->model('projects');
			$update['id'] = $this->session->userdata('current_item');
			$update['translit'] = $this->translite($update['title']);
			$this->projects->update_record($update);
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Проект сохранен<hr/>';
			$text .= '<li><a href="'.site_url('projects').'" target="_blank">Просмотреть проекты</a></li>';
			$text .= '<li><a href="'.site_url('administrator/projects').'">К списку проектов</a></li></ul>';
			echo $text;
		else:
			$text = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при сохранении<hr/>';
		endif;
	}
	
	public function deleteProject(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$project = $this->input->post('parameter');
		$json_request = array('status'=>FALSE,'message'=>'');
		if($project):
			$this->load->model('projects');
			$this->projects->delete_record($project,'projects');
			$json_request['status'] = TRUE;
			$json_request['message'] = '<img src="'.site_url('img/check.png').'" alt="" /> Проект удален';
		else:
			$json_request['message'] = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при удалении<hr/>';
		endif;
		echo json_encode($json_request);
	}
	
	public function updateProjectPhoto(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		if($_FILES['photo']['error'] != 4):
			$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
			$photo = file_get_contents($_FILES['photo']['tmp_name']);
			if($photo):
				$this->load->model('projects');
				$project_id = $this->session->userdata('current_item');
				if($project_id):
					$this->projects->update_field($project_id,'photo',$photo,'projects');
					$this->load->helper('string');
					$json_request['responsePhotoSrc'] = site_url('loadimage/project/'.$project_id.'?'.random_string('alpha',5));
					$json_request['status'] = TRUE;
				endif;
			endif;
		endif;
		if($json_request['status']):
			$json_request['responseText'] = 'Файл загружен';
		else:
			$json_request['responseText'] = 'Ошибка при загрузке';
		endif;
		echo json_encode($json_request);
	}
	
	/************************************************* pertner ************************************************************/
	public function insertPartner(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$insert = $this->input->post();
		if($insert):
			$this->load->model('partners');
			$partner_id = $this->partners->insert_record($insert);
			if($partner_id):
				if(isset($_FILES['photo'])):
					if($_FILES['photo']['error'] != 4):
						$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->partners->update_field($partner_id,'photo',$photo,'partners');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Партнер добавлен<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/object/partners/add').'">Добавить партнера</a>';
				if($partner_id):
					$text .= '<li><a href="'.site_url('administrator/object/partners/edit/'.$partner_id).'">Редактировать созданного партнера</a></li>';
					$text .= '<li><a href="'.site_url('object/partners').'" target="_blank">Просмотреть партнеров</a></li>';
				endif;
				$text .= '<li><a href="'.site_url('administrator/object/partners').'">К списку партнеров</a></li></ul>';
				echo $text;
			endif;
		endif;
	}
	
	public function updatePartner(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$update = $this->input->post();
		if($update && $this->session->userdata('current_item')):
			$this->load->model('partners');
			$update['id'] = $this->session->userdata('current_item');
			$this->partners->update_record($update);
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Партнер сохранен<hr/>';
			$text .= '<li><a href="'.site_url('projects').'" target="_blank">Просмотреть партнеров</a></li>';
			$text .= '<li><a href="'.site_url('administrator/object/partners').'">К списку партнеров</a></li></ul>';
			echo $text;
		else:
			$text = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при сохранении<hr/>';
		endif;
	}
	
	public function deletePartner(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$partner = $this->input->post('parameter');
		$json_request = array('status'=>FALSE,'message'=>'');
		if($partner):
			$this->load->model('partners');
			$this->partners->delete_record($partner,'partners');
			$json_request['status'] = TRUE;
			$json_request['message'] = '<img src="'.site_url('img/check.png').'" alt="" /> Партнер удален';
		else:
			$json_request['message'] = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при удалении<hr/>';
		endif;
		echo json_encode($json_request);
	}
	
	public function updatePartnerPhoto(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		if($_FILES['photo']['error'] != 4):
			$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
			$photo = file_get_contents($_FILES['photo']['tmp_name']);
			if($photo):
				$this->load->model('partners');
				$partner = $this->session->userdata('current_item');
				if($partner):
					$this->partners->update_field($partner,'photo',$photo,'partners');
					$this->load->helper('string');
					$json_request['responsePhotoSrc'] = site_url('loadimage/partner/'.$partner.'?'.random_string('alpha',5));
					$json_request['status'] = TRUE;
				endif;
			endif;
		endif;
		if($json_request['status']):
			$json_request['responseText'] = 'Файл загружен';
		else:
			$json_request['responseText'] = 'Ошибка при загрузке';
		endif;
		echo json_encode($json_request);
	}
	
	/************************************************* photos **************************************************************/
	public function saveObjectPhoto(){
		
		$this->load->model('object_images');
		$randomNumber = mt_rand(1,1000);
		$insert = array('title'=>0,'src'=>'');
		$fn = (isset($_SERVER['HTTP_X_FILENAME'])?$_SERVER['HTTP_X_FILENAME']:false);
		if($fn):
			$newFileName = preg_replace('/.+(.)(\.)+/','object_'.$randomNumber."\$2",$fn);
			file_put_contents(getcwd().'/upload_images/'.$newFileName,file_get_contents('php://input'));
			echo "$fn загружен";
			$insert['src'] = 'upload_images/'.$newFileName;
			$this->object_images->insert_record($insert);
			exit();
		else:
			if(isset($_FILES['fileselect'])):
				$files = $_FILES['fileselect'];
				$i = 0;
				foreach($files['error'] as $id => $err):
					if($err == UPLOAD_ERR_OK):
						$fn = $files['name'][$id];
						$newFileName = preg_replace('/.+(.)(\.)+/','object_'.$randomNumber."\$2",$fn);
						move_uploaded_file($files['tmp_name'][$id],getcwd().'/upload_images/'.$newFileName);
						$insert['src'] = 'upload_images/'.$newFileName;
						$this->object_images->insert_record($insert);
						echo "<p>File $fn uploaded.</p>";
						$i++;
					endif;
				endforeach;
			else:
				show_404();
			endif;
		endif;
	}
	
	public function deleteObjectPhoto(){
		
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
				$this->load->model('object_images');
				for($i=0;$i<count($dataval);$i++):
					$image = $this->object_images->read_record($dataval[$i],'object_images');
					$this->filedelete(getcwd().'/'.$image['src']);
					$this->object_images->delete_record($image['id'],'object_images');
				endfor;
				$json_request['status'] = TRUE;
				$json_request['message'] = "Изображений удалено: ".count($dataval);
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	public function titleObjectPhoto(){
		
		if(!$this->input->is_ajax_request()):
			show_error('Аccess denied');
		endif;
		$json_request = array('status'=>FALSE);
		$data = trim($this->input->post('postdata'));
		if($data):
			$data = preg_split("/&/",$data);
			for($i=0;$i<count($data);$i++):
				$dataid = preg_split("/=/",$data[$i]);
				$dataval[$i] = trim($dataid[1]);
			endfor;
			if($dataval):
				$this->load->model('object_images');
				$this->object_images->update_field($dataval[0],'title',$dataval[1],'object_images');
				$json_request['status'] = TRUE;
			endif;
		endif;
		echo json_encode($json_request);
	}
	
	/************************************************* people ************************************************************/
	public function insertPeople(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$insert = $this->input->post();
		if($insert):
			$this->load->model('people');
			$people = $this->people->insert_record($insert);
			if($people):
				if(isset($_FILES['photo'])):
					if($_FILES['photo']['error'] != 4):
						$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->people->update_field($people,'photo',$photo,'people');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Человек добавлен<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/people/add').'">Добавить человека</a>';
				if($people):
					$text .= '<li><a href="'.site_url('administrator/people/edit/'.$people).'">Редактировать созданного человека</a></li>';
					$text .= '<li><a href="'.site_url('people').'" target="_blank">Просмотреть людей</a></li>';
				endif;
				$text .= '<li><a href="'.site_url('administrator/people').'">К списку людей</a></li></ul>';
				echo $text;
			endif;
		endif;
	}
	
	public function updatePeople(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$update = $this->input->post();
		if($update && $this->session->userdata('current_item')):
			$this->load->model('people');
			$update['id'] = $this->session->userdata('current_item');
			$this->people->update_record($update);
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Человек сохранен<hr/>';
			$text .= '<li><a href="'.site_url('people').'" target="_blank">Просмотреть людей</a></li>';
			$text .= '<li><a href="'.site_url('administrator/people').'">К списку людей</a></li></ul>';
			echo $text;
		else:
			$text = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при сохранении<hr/>';
		endif;
	}
	
	public function deletePeople(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$partner = $this->input->post('parameter');
		$json_request = array('status'=>FALSE,'message'=>'');
		if($partner):
			$this->load->model('people');
			$this->people->delete_record($partner,'people');
			$json_request['status'] = TRUE;
			$json_request['message'] = '<img src="'.site_url('img/check.png').'" alt="" /> Человек удален';
		else:
			$json_request['message'] = '<img src="'.site_url('img/no-check.png').'" alt="" /> Ошибка при удалении<hr/>';
		endif;
		echo json_encode($json_request);
	}
	
	public function updatePeoplePhoto(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','responsePhotoSrc'=>'');
		if($_FILES['photo']['error'] != 4):
			$this->image_manupulation($_FILES['photo']['tmp_name'],'width',TRUE,200,200);
			$photo = file_get_contents($_FILES['photo']['tmp_name']);
			if($photo):
				$this->load->model('people');
				$people = $this->session->userdata('current_item');
				if($people):
					$this->people->update_field($people,'photo',$photo,'people');
					$this->load->helper('string');
					$json_request['responsePhotoSrc'] = site_url('loadimage/people/'.$people.'?'.random_string('alpha',5));
					$json_request['status'] = TRUE;
				endif;
			endif;
		endif;
		if($json_request['status']):
			$json_request['responseText'] = 'Файл загружен';
		else:
			$json_request['responseText'] = 'Ошибка при загрузке';
		endif;
		echo json_encode($json_request);
	}
	
	/************************************************* profiles ***********************************************************/
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