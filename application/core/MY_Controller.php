<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	var $user = array('uid'=>0,'email'=>'');
	var $loginstatus = FALSE;
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('users');
		$cookieuid = $this->session->userdata('logon');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if(isset($this->user['uid']) && !is_null($this->user['uid'])):
				$userinfo = $this->users->read_record($this->user['uid'],'users');
				if($userinfo):
					$this->user['email'] = $userinfo['email'];
					$this->loginstatus = TRUE;
				endif;
			endif;
			if($this->session->userdata('logon') != md5($userinfo['email'])):
				$this->loginstatus = FALSE;
				$this->user = array();
			endif;
		endif;
	}
	
	public function pagination($url,$uri_segment,$total_rows,$per_page){
		
		$this->load->library('pagination');
		$config['base_url'] 		= base_url()."$url/offset/";
		$config['uri_segment'] 		= $uri_segment;
		$config['total_rows'] 		= $total_rows;
		$config['per_page'] 		= $per_page;
		$config['num_links'] 		= 4;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['full_tag_open'] 	= '<div class="pagination"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	
	public function send_mail($to,$from_mail,$from_name,$subject,$text,$attach = NULL){
		
		$this->load->library('email');
		$this->email->clear(TRUE);
		$config['smtp_host'] = 'localhost';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		
		$this->email->initialize($config);
		$this->email->to($to);
		$this->email->from($from_mail,$from_name);
		$this->email->bcc('');
		$this->email->subject($subject);
		for($i=0;$i<count($attach);$i++):
			$this->email->attach($attach[$i]['path']);
		endfor;
		$this->email->message($text);
		if($this->email->send()):
			return TRUE;
		else:
			show_error($this->email->print_debugger());
		endif;
	}
	
	public function loadimage(){
		
		$section = $this->uri->segment(2);
		$id = $this->uri->segment(3);
		switch ($section):
			case 'photo':$image = $this->users->read_field($id,'users','photo'); break;
			default : show_error('Рисунок не найден');break;
		endswitch;
		if(!$image):
			$image = file_get_contents(getcwd().'/img/icons/no_icon.jpg');
		endif;
		header('Content-type: image/gif');
		echo $image;
	}
	
	public function image_manupulation($userfile,$dim,$ratio,$width = FALSE,$height = FALSE){
		
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $userfile;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = $ratio;
		$config['master_dim'] = $dim;
		$config['width'] = $width;
		$config['height'] = $height;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	public function fileupload($userfile,$overwrite,$catalog){
		
		$config['upload_path'] = $catalog.'/';
		$config['allowed_types'] = 'doc|docx|xls|xlsx|txt|pdf|ppt|pptx';
		$config['remove_spaces'] = TRUE;
		$config['overwrite'] = $overwrite;
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload($userfile)):
			show_error($this->upload->display_errors());
		endif;
		return TRUE;
	}

	public function filedelete($file){
		
		if(is_file($file)):
			@unlink($file);
			return TRUE;
		else:
			return FALSE;
		endif;
	}

	public function translite($string){
		
		$rus = array("1","2","3","4","5","6","7","8","9","0","ё","й","ю","ь","ч","щ","ц","у","к","е","н","г","ш","з","х","ъ","ф","ы","в","а","п","р","о","л","д","ж","э","я","с","м","и","т","б","Ё","Й","Ю","Ч","Ь","Щ","Ц","У","К","Е","Н","Г","Ш","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","С","М","И","Т","Б"," ");
		$eng = array("1","2","3","4","5","6","7","8","9","0","yo","iy","yu","","ch","sh","c","u","k","e","n","g","sh","z","h","","f","y","v","a","p","r","o","l","d","j","е","ya","s","m","i","t","b","Yo","Iy","Yu","CH","","SH","C","U","K","E","N","G","SH","Z","H","","F","Y","V","A","P","R","O","L","D","J","E","YA","S","M","I","T","B","-");
		$string = str_replace($rus,$eng,$string);
		if(!empty($string)):
			$string = preg_replace('/[^a-z0-9-\.]/','',strtolower($string));
			$string = preg_replace('/[-]+/','-',$string);
			$string = preg_replace('/[\.]+/','.',$string);
			return $string;
		else:
			return FALSE;
		endif;
	}

	public function english_symbol($string){
		
		if(!empty($string)):
			$string = preg_replace('/[ ]+/','-',strtolower($string));
			$string = preg_replace('/[^a-z,-]/','',$string);
			$string = preg_replace('/[-]+/','-',$string);
			return $string;
		else:
			return FALSE;
		endif;
	}
	
	public function valid_url_symbol($string){
		
		if(!empty($string)):
			$string = preg_replace('/[ ]+/','-',strtolower($string));
			$string = preg_replace('/[^a-z0-9,-\/\?\&\$\#\@]/','',strtolower($string));
			$string = preg_replace('/[-]+/','-',$string);
			$string = preg_replace('/[\.\?\!\)\(\,\:\;]/','',$string);
			return $string;
		else:
			return FALSE;
		endif;
	}

}