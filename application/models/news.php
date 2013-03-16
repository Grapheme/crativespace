<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Model{

	var $id = 0;
	var $title = ''; var $content = ''; var $date_publish = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		if(!empty($data['title'])):
			$this->title = $data['title'];
		endif;
		if(!empty($data['content'])):
			$this->content = $data['content'];
		endif;
		$this->date_publish = $data['date'].' '.date("H:i:s");
		$this->db->insert('news',$this);
		return $this->db->insert_id();
	}
	
	function update_record($data){
		
		if(!empty($data['title'])):
			$this->db->set('title',$data['title']);
		endif;
		$this->db->set('content',$data['content']);
		if(!empty($data['date'])):
			$this->db->set('date_publish',$data['date'].' '.date("H:i:s"));
		endif;
		$this->db->where('id',$data['id']);
		$this->db->update('news');
		return $this->db->affected_rows();
	}
	
	function newsInformation($news){
		
		$this->db->select('id,title,content,date_publish');
		$query = $this->db->get_where('news',array('id'=>$news),1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}

}