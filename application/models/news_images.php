<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class News_images extends MY_Model{

	var $id = 0;var $news = 0;
	var $src = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->news = $data['news'];
		$this->src = $data['src'];
		$this->db->insert('news_images',$this);
		return $this->db->insert_id();
	}
	
	function delete_records($new){
	
		$this->db->where('news',$new);
		$this->db->delete('news_images');
		return $this->db->affected_rows();
	}
	
	function photoNews($news){
		
		$query = $this->db->get_where('news_images',array('news'=>$news));
		$data = $query->result_array();
		if($data) return $data;
		return NULL;
	}
}