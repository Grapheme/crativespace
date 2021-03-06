<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Model{

	var $id = 0;
	var $title = ''; var $translit = ''; var $content = ''; var $date_publish = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->title = $data['title'];
		$this->translit = $data['translit'];
		$this->content = $data['content'];
		$this->date_publish = $data['date'].' '.date("H:i:s");
		$this->db->insert('news',$this);
		return $this->db->insert_id();
	}
	
	function update_record($data){
		
		$this->db->set('title',$data['title']);
		$this->db->set('translit',$data['translit']);
		$this->db->set('content',$data['content']);
		$this->db->set('date_publish',$data['date'].' '.date("H:i:s"));
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
	
	function read_limit_records($count,$offset,$table){
		
		$this->db->select('id,title,translit,content,date_publish');
		$this->db->order_by('date_publish','DESC');
		$this->db->limit($count,$offset);
		$query = $this->db->get($table);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}