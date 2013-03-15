<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class People extends MY_Model{

	var $id = 0;
	var $name = ''; var $photo = ''; var $company = '';var $phone = '';var $email = '';var $position = '';
	var $facebook = ''; var $twitter = ''; var $vk = ''; var $google = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->name = $data['name'];
		$this->company = $data['company'];
		$this->position = $data['position'];
		$this->phone = $data['phone'];
		$this->email = $data['email'];
		$this->facebook = $data['facebook'];
		$this->twitter = $data['twitter'];
		$this->vk = $data['vk'];
		$this->google = $data['google'];
		$this->db->insert('people',$this);
		return $this->db->insert_id();
	}
	
 	function update_record($data){
		
		$this->db->set('name',$data['name']);
		$this->db->set('company',$data['company']);
		$this->db->set('position',$data['position']);
		$this->db->set('email',$data['email']);
		$this->db->set('phone',$data['phone']);
		$this->db->set('facebook',$data['facebook']);
		$this->db->set('twitter',$data['twitter']);
		$this->db->set('vk',$data['vk']);
		$this->db->set('google',$data['google']);
		$this->db->where('id',$data['id']);
		$this->db->update('people');
		return $this->db->affected_rows();
	}
	
	function projectInformation($partner){
		
		$this->db->select('id,name,company,position,email,phone,facebook,twitter,vk,google');
		$query = $this->db->get_where('people',array('id'=>$partner),1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
}