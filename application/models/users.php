<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Model{

	var $id = 0;
	var $email = '';
	var $password = '';
	var $signdate = '';

	function __construct(){
		parent::__construct();
	}
	
	function auth_user($login,$password){
		
		$this->db->select('id');
		$this->db->where('email',$login);
		$this->db->where('password',md5($password));
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if($data) return $data[0];
		return FALSE;
	}

	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['id'];
		return FALSE;
	}

	function valid_password($id,$field,$parameter){
			
		$this->db->where('id',$id);
		$this->db->where($field,$parameter);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['id'];
		return FALSE;
	}
	
}