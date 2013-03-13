<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Union extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	/********************************************* users lists ********************************************************/
	
	function universitiesListByPages($class,$count,$offset){
		
		$query = "SELECT users.id,users.user_id,users.email,users.signdate,users.active,universities.name,universities.time_zone,languages.name AS language FROM users INNER JOIN universities ON users.user_id = universities.id INNER JOIN languages ON users.language = languages.id WHERE users.class = $class ORDER BY users.signdate DESC,users.id LIMIT $offset,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function teachersListByPages($class,$count,$offset){
		
		$query = "SELECT users.id,users.user_id,users.email,users.signdate,users.active,teachers.name,teachers.surname,teachers.time_zone,languages.name AS language FROM users INNER JOIN teachers ON users.user_id = teachers.id INNER JOIN languages ON users.language = languages.id WHERE users.class = $class ORDER BY users.signdate DESC,users.id LIMIT $offset,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function studentsListByPages($class,$count,$offset){
		
		$query = "SELECT users.id,users.user_id,users.email,users.signdate,users.active,students.name,students.surname,students.time_zone,students.contacts,students.note,languages.name AS language FROM users INNER JOIN students ON users.user_id = students.id INNER JOIN languages ON users.language = languages.id WHERE users.class = $class ORDER BY users.signdate DESC,users.id LIMIT $offset,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	/************************************************* study *********************************************************/
	
	function universitySubjects($university,$count,$offset){
		
		$query = "SELECT university_subjects.id AS sid,university_subjects.title,university_subjects.note_short,university_subjects.faculty,university_subjects.publish FROM university_subjects WHERE university_subjects.university = $university ORDER BY university_subjects.title LIMIT $offset,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function counUniversitySubjects($university){
		
		$query = "SELECT COUNT(*) AS cnt FROM university_subjects WHERE university_subjects.university = $university";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if($data) return $data[0]['cnt'];
		return 0;
	}
	
	/*****************************************************************************************************************/
}