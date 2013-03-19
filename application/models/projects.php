<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Model{

	var $id = 0;
	var $translit = '';var $title = ''; var $content = ''; var $photo = '';var $people = '';var $site = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->translit = $data['translit'];
		$this->title = $data['title'];
		$this->content = $data['content'];
		$this->people = $data['people'];
		$this->site = $data['site'];
		$this->db->insert('projects',$this);
		return $this->db->insert_id();
	}
	
 	function update_record($data){
		
		$this->db->set('title',$data['title']);
		$this->db->set('content',$data['content']);
		$this->db->set('people',$data['people']);
		$this->db->set('site',$data['site']);
		$this->db->where('id',$data['id']);
		$this->db->update('projects');
		return $this->db->affected_rows();
	}
	
	function projectInformation($project){
		
		$this->db->select('id,translit,title,content,people,site');
		$query = $this->db->get_where('projects',array('id'=>$project),1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
	function read_records($table,$field = 'id',$order = 'ASC'){
		
		$this->db->select('id,translit,title,content,people,site');
		$this->db->order_by($field,$order);
		$query = $this->db->get($table);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
}