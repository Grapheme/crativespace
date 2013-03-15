<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Partners extends MY_Model{

	var $id = 0;
	var $title = ''; var $photo = ''; var $office = '';var $site = '';var $email = '';
	var $facebook = ''; var $twitter = ''; var $vk = ''; var $google = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->title = $data['title'];
		$this->office = $data['office'];
		$this->site = $data['site'];
		$this->email = $data['email'];
		$this->facebook = $data['facebook'];
		$this->twitter = $data['twitter'];
		$this->vk = $data['vk'];
		$this->google = $data['google'];
		$this->db->insert('partners',$this);
		return $this->db->insert_id();
	}
	
 	function update_record($data){
		
		$this->db->set('title',$data['title']);
		$this->db->set('office',$data['office']);
		$this->db->set('email',$data['email']);
		$this->db->set('site',$data['site']);
		$this->db->set('facebook',$data['facebook']);
		$this->db->set('twitter',$data['twitter']);
		$this->db->set('vk',$data['vk']);
		$this->db->set('google',$data['google']);
		$this->db->where('id',$data['id']);
		$this->db->update('partners');
		return $this->db->affected_rows();
	}
	
	function projectInformation($partner){
		
		$this->db->select('id,title,office,email,site,facebook,twitter,vk,google');
		$query = $this->db->get_where('partners',array('id'=>$partner),1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
}