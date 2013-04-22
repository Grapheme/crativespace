<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Model{

	var $id = 0;var $liked = 0;
	var $title = ''; var $translit = ''; var $content = ''; var $date_begin = ''; var $photo = ''; var $date = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->title = $data['title'];
		$this->translit = $data['translit'];
		$this->db->set('translit',$data['translit']);
		$this->content = $data['content'];
		$this->date_begin = $data['date_begin'];
		$this->date = $data['date'];
		$this->db->insert('events',$this);
		return $this->db->insert_id();
	}
	
 	function update_record($data){
		
		$this->db->set('title',$data['title']);
		$this->db->set('translit',$data['translit']);
		$this->db->set('content',$data['content']);
		$this->db->set('date_begin',$data['date_begin']);
		$this->db->set('date',$data['date']);
		$this->db->where('id',$data['id']);
		$this->db->update('events');
		return $this->db->affected_rows();
	}
	
	function eventInformation($event){
		
		$this->db->select('id,title,content,date_begin,date');
		$query = $this->db->get_where('events',array('id'=>$event),1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
	function read_limit_records($count,$offset,$table){
		
		$this->db->select('id,title,translit,content,date_begin,date');
		$this->db->order_by('date','DESC');
		$this->db->limit($count,$offset);
		$query = $this->db->get($table);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
}