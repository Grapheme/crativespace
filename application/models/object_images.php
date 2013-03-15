<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Object_images extends MY_Model{

	var $id = 0;
	var $title = ''; var $src = '';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->src = $data['src'];
		$this->db->insert('object_images',$this);
		return $this->db->insert_id();
	}
}