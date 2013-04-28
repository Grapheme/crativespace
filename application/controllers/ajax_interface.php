<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_interface extends MY_Controller{
	
	var $per_page = 6;
	var $offset = 0;
	
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
	
	public function sendFeedBack(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'message'=>'Сообщенеи не отправлено');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user-email','','required|trim|valid_email|xss_clean');
		$this->form_validation->set_rules('user-phone','','trim|xss_clean');
		$this->form_validation->set_rules('user-content','','required|trim|xss_clean');
		if($this->form_validation->run()):
			ob_start();?>
<p>Здравствуйте, <em>Администратор</em></p>
<p>Номер телефона пользователя: <?=(!empty($_POST['user-phone']))?$_POST['user-phone']:'Не указан';?></p>
<p>Email адрес пользователя: <?=$_POST['user-email'];?></p>
<p>Сообщение от пользователя:<br/><?=$_POST['user-content']?></p>
			<?php $mailtext = ob_get_clean();
			$this->send_mail('info@creativespace.pro',$_POST['user-email'],$_POST['user-email'],$_POST['user-thema'].'. Форма обратной связи',$mailtext);
			$json_request['status'] = TRUE;
			$json_request['message'] = 'Сообщение отправлено';
		else:
			$json_request['message'] = 'Неверно заполнены поля';
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
	
	public function setItemLike(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'liked'=>0);
		$data = trim($this->input->post('postdata'));
		if($data):
			$data = preg_split("/&/",$data);
			for($i=0;$i<count($data);$i++):
				$dataid = preg_split("/=/",$data[$i]);
				$dataval[$i] = trim($dataid[1]);
			endfor;
			if($dataval):
				$this->load->model($dataval[1]);
				$json_request['liked'] = $this->$dataval[1]->read_field($dataval[0],$dataval[1],'liked') + 1;
				$this->$dataval[1]->update_field($dataval[0],'liked',$json_request['liked'],$dataval[1]);
				$json_request['status'] = TRUE;
			endif;
		endif;
		echo json_encode($json_request);
	}

	public function textScrollLoad(){
		
		if(!$this->input->is_ajax_request()):
			show_error('Аccess denied');
		endif;
		$this->offset = $this->uri->segment(4);
		$table = $this->uri->segment(2);
		$this->load->helper('date');
		$this->load->helper('text');
		$next_items = FALSE;
		if($table == 'news'):
			$this->load->model($table);
			$content = $this->$table->read_limit_records($this->per_page,$this->offset,$table);
			$next_items = $this->$table->exist_next_records($this->offset,$table);
		endif;
		if($table == 'events'):
			$this->load->model($table);
			$content = $this->$table->read_limit_records($this->per_page,$this->offset,$table);
			$next_items = $this->$table->exist_next_records($this->offset,$table);
		endif;
		$this->load->model('news_images');
		$html = '';
		for($i=0;$i<count($content);$i++):
			$smalltext = trim(word_limiter($content[$i]['content'],100,' ...</p>'));
			if($table == 'news'):
				$photos = $this->news_images->photoNews($content[$i]['id']);
				$html .= '<div class="news_div"><p><span class="news_title">'.$content[$i]['title'].'</span><br><span class="news_date">'.month_date_with_time($content[$i]['date_publish']).'</span>';
				$html .= '</p><span class="news_text view-text">'.$smalltext;
				$html .= '</span>';
				if(count($photos)):
					$html .= '<p class="number_photo"><a href="#" class="prev"><img src="'.site_url('img/left.jpg').'" class="left"></a>1 / '.count($photos).'<a href="#" class="next"><img src="'.site_url('img/right.jpg').'" class="right"></a></p>';
					$html .= '<div class="news_img_div cycle-slideshow" data-cycle-prev=".prev" data-cycle-next=".next" data-cycle-fx="fade" data-cycle-timeout=0>';
					for($j=0;$j<count($photos);$j++):
						$html .= '<img class="news_img" src="'.site_url($photos[$j]['src']).'">';
					endfor;
					$html .= '</div>';
				endif;
				//$html .= '<div class="like_div"><a href="#" class="def"><div class="like"><img src="'.site_url('img/like.jpg').'"></div>25</a></div></div>';
			endif;
			if($table == 'events'):
				$html .= '<div class="event_page_div"><div class="grid_6 prefix_1"><span class="event_date">'.month_date($content[$i]['date']).' '.$content[$i]['date_begin'].'</span>';
				$html .= '<p class="event_title">'.$content[$i]['title'].'</p><span class="event_text view-text">'.$smalltext;
				$html .= '</span>';
				//$html .= '<div class="like_div"><a href="#" class="def"><div class="like"><img src="'.site_url('img/like.jpg').'"></div>25</a></div>';
				$html .= '</div><div class="grid_5"><div class="event_page_image"><img src="'.site_url('loadimage/events/'.$content[$i]['id']).'"></div></div></div>';
			endif;
		endfor;
		if($next_items):
			$offset = $this->per_page+$this->offset;
			$html .= '<div class="next"><a href="'.site_url("text-load/$table/from/$offset").'">Еще ...</a></div>';
		endif;
		echo $html;
	}

	public function projectLoad(){
		
		if(!$this->input->is_ajax_request()):
			show_error('Аccess denied');
		endif;
		$project = $this->input->post('parameter');
		$html = '';
		if($project):
			$this->load->model('projects');
			$content = $this->projects->read_record($project,'projects');
			
			if(!empty($content['people'])):
				$people = json_decode($content['people']);
				if($people):
					$this->load->model('people');
					$content['people'] = $this->people->peopleArray($people);
				else:
					$content['people'] = FALSE;
				endif;
			endif;
			
			$html .= '<img src="'.site_url('loadimage/project/'.$content['id']).'">';
			$html .= '<div class="dobrocoworkru_explain">'.$content['content'].'</div>';
			
			$html .= '<div class="projects_people">';
			if($content['people']):
				$html .= '<p class="dobrocoworkru_people">ЛЮДИ: ';
				for($i=0;$i<count($content['people']);$i++):
					$html .= '<a href="#" data-item="'.$content['people'][$i]['id'].'" class="people_div">'.$content['people'][$i]['name'].'</a>';
					if(isset($content['people'][$i+1]['id'])):
						$html .= ',';
					endif;
				endfor;
				$html .= '</p>';
			endif;
			$html .= '<a class="dobrocoworkru" target="_blank" href="http://'.$content['site'].'">'.$content['site'].'</a></div>';
			echo $html;
		else:
			echo 'Данные отсутствуют';
		endif;
	}
	
	public function partnerLoad(){
		
		if(!$this->input->is_ajax_request()):
			show_error('Аccess denied');
		endif;
		$partner = $this->input->post('parameter');
		$html = '';
		if($partner):
			$this->load->model('partners');
			$content = $this->partners->read_record($partner,'partners');
			$html .= '<img  src="'.site_url('loadimage/partner/'.$content['id']).'"><div class="popup_partner_div"><div class="popup_contacts">';
			$html .= '<p><span class="popup_mast">'.$content['title'].'<br>офис № '.$content['office'].'</span></p>';
			$html .= '<span class="popup_desc"><a href="http://'.$content['site'].'" target="_blank">'.$content['site'].'</a></span><br>';
			$html .= '<span class="popup_desc"><a href="mailto:'.$content['email'].'">'.$content['email'].'</a></span>';
			$html .= '<p>';
			if(!empty($content['facebook'])):
				$html .= '<a target="_blank" href="'.$content['facebook'].'"><img src="'.site_url('img/facebook_button.jpg').'"></a>';
			endif;
			if(!empty($content['twitter'])):
				$html .= '<a target="_blank" href="'.$content['twitter'].'"><img src="'.site_url('img/twitter_button.jpg').'"></a>';
			endif;
			if(!empty($content['vk'])):
				$html .= '<a target="_blank" href="'.$content['vk'].'"><img src="'.site_url('img/vk_button.jpg').'"></a>';
			endif;
			if(!empty($content['google'])):
				$html .= '<a target="_blank" href="'.$content['google'].'"><img src="'.site_url('img/gplus_button.jpg').'"></a>';
			endif;
			$html .= '</p></div></div>';
			echo $html;
		else:
			echo 'Данные отсутствуют';
		endif;
	}

	public function peopleLoad(){
		
		if(!$this->input->is_ajax_request()):
			show_error('Аccess denied');
		endif;
		$people = $this->input->post('parameter');
		$html = '';
		if($people):
			$this->load->model('people');
			$content = $this->people->read_record($people,'people');
			$html .= '<img class="popup_person_img" src="'.site_url('loadimage/people/'.$content['id']).'">';
			$html .= '<div class="popup_text_div"><div class="popup_border top">';
			$html .= '<span class="popup_name">'.$content['name'].'</span><br>';
			$html .= '<span class="popup_pos">'.$content['position'].'</span></div><div class="popup_border middle">';
			$html .= '<span class="popup_desc"><a href="#">'.$content['company'].'</a></span></div>';
			$html .= '<div class="popup_contacts"><span class="popup_desc">'.$content['phone'].'</span><br>';
			$html .= '<span class="popup_desc"><a href="#">'.$content['email'].'</a></span>';
			$html .= '<p>';
			if(!empty($content['facebook'])):
				$html .= '<a target="_blank" href="'.$content['facebook'].'"><img src="'.site_url('img/facebook_button.jpg').'"></a>';
			endif;
			if(!empty($content['twitter'])):
				$html .= '<a target="_blank" href="'.$content['twitter'].'"><img src="'.site_url('img/twitter_button.jpg').'"></a>';
			endif;
			if(!empty($content['vk'])):
				$html .= '<a target="_blank" href="'.$content['vk'].'"><img src="'.site_url('img/vk_button.jpg').'"></a>';
			endif;
			if(!empty($content['google'])):
				$html .= '<a target="_blank" href="'.$content['google'].'"><img src="'.site_url('img/gplus_button.jpg').'"></a>';
			endif;
			$html .= '</p></div></div>';
			echo $html;
		else:
			echo 'Данные отсутствуют';
		endif;
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
			$insert['translit'] = $this->translite($insert['title']);
			$news_id = $this->news->insert_record($insert);
			if($news_id):
				$this->session->set_userdata('current_item',$news_id);
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Новость добавлена<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/news/add').'">Добавить новость</a></li>';
				$text .= '<li><a id="load-images" href="#">Добавить изображения к созданной новости</a></li>';
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
			$update['translit'] = $this->translite($update['title']);
			$this->news->update_record($update);
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Новость сохранена<hr/>';
			$text .= '<ul><li><a href="'.site_url('administrator/news/edit/images/'.$update['id']).'">Управлять изображеними к текущей новости</a></li>';
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
			$insert['translit'] = $this->translite($insert['title']);
			$event_id = $this->events->insert_record($insert);
			if($event_id):
				if(isset($_FILES['photo'])):
					if($_FILES['photo']['error'] != 4):
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->events->update_field($event_id,'photo',$photo,'events');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Мероприятие добавлено<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/events/add').'">Добавить мероприятие</a></li>';
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
			$update['translit'] = $this->translite($update['title']);
			$this->events->update_record($update);
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Мероприятие сохранено<hr/>';
			$text .= '<ul><li><a href="'.site_url('events').'" target="_blank">Просмотреть мероприятие</a></li>';
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
			if(isset($insert['people'])):
				$insert['people'] = json_encode($insert['people']);
			else:
				$insert['people'] = '';
			endif;
			$project_id = $this->projects->insert_record($insert);
			if($project_id):
				if(isset($_FILES['photo'])):
					if($_FILES['photo']['error'] != 4):
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->projects->update_field($project_id,'photo',$photo,'projects');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Проект добавлен<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/projects/add').'">Добавить проект</a></li>';
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
			if(isset($update['people'])):
				$update['people'] = json_encode($update['people']);
			else:
				$update['people'] = '';
			endif;
			$this->projects->update_record($update);
			$this->session->unset_userdata('current_item');
			$text = '<img src="'.site_url('img/check.png').'" alt="" /> Проект сохранен<hr/>';
			$text .= '<ul><li><a href="'.site_url('projects').'" target="_blank">Просмотреть проекты</a></li>';
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
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->partners->update_field($partner_id,'photo',$photo,'partners');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Партнер добавлен<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/object/partners/add').'">Добавить партнера</a></li>';
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
			$text .= '<ul><li><a href="'.site_url('projects').'" target="_blank">Просмотреть партнеров</a></li>';
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
	
	public function objectPhotoSort(){
		
		if(!$this->input->is_ajax_request()):
			show_error('Аccess denied');
		endif;
		$list = trim($this->input->post('list'));
		if($list):
			$list = preg_split("/&/",$list);
			for($i=0;$i<count($list);$i++):
				$dataid = preg_split("/=/",$list[$i]);
				$dataval[$i] = $dataid[1];
			endfor;
			if($dataval):
				$this->load->model('object_images');
				$items = $this->object_images->read_records('object_images');
				for($i=0;$i<count($items);$i++):
					$this->object_images->update_field($dataval[$i],'position',$i+1,'object_images');
				endfor;
			endif;
		endif;
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
						$photo = file_get_contents($_FILES['photo']['tmp_name']);
						if($photo):
							$this->people->update_field($people,'photo',$photo,'people');
						endif;
					endif;
				endif;
				$text = '<img src="'.site_url('img/check.png').'" alt="" /> Человек добавлен<hr/>';
				$text .= '<ul><li><a href="'.site_url('administrator/people/add').'">Добавить человека</a></li>';
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
			$text .= '<ul><li><a href="'.site_url('people').'" target="_blank">Просмотреть людей</a></li>';
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