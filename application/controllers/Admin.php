<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index() {
		$data['view_name'] = 'dashboard';
		$this->load->view('template',$data);
	}

	public function login() {
		if(!empty($this->input->post())){
			if ($this->valid_login() == TRUE) {

				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));

				$table = "users";
				$where = "vUsername = '$username' AND vPassword = '$password'";

				$user = $this->common->getTableData($table,$where);

				$user = !empty($user)?$user[0]:array();
				if($user['iStatus'] != 1){
					$this->session->set_flashdata("error","User has been suspended!");
					redirect('admin/login');
				}
				$this->session->set_userdata(array(
					"user_id" => $user["iUserId"],
				));

				$this->session->set_flashdata("success","Login successfully");
				redirect('admin');
            }
		}

		$this->load->view('login');
	}

	public function logout() {
		session_destroy();
		redirect('admin/login');
	}

	public function users() {
		$table = "users";
		$where = "iUserTypeId = '2' AND dtDeletedAt IS NULL";

		$users = $this->common->getTableData($table,$where,"*,(SELECT GROUP_CONCAT(c.vCourse) FROM student_course_trance as sct INNER JOIN course as c ON sct.iCourseId = c.iCourseId WHERE c.iStatus = 1 AND c.dtDeletedAt IS NULL AND sct.iUserId = users.iUserId) AS vCourse");

		$data['users'] = $users;
		$data['view_name'] = 'users';
		$data['js_files'] = array('https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js','https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js');
		$data['css_files'] = array('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css');

		$this->load->view('template',$data);
	}

	public function add_student($iUserId = NULL) {
		$table = "users";
		$where = NULL;
		if(!empty($iUserId)){
			$where = "iUserId = '$iUserId'";
			$user = $this->common->getTableData($table,$where);

			$table = "student_course_trance";
			$user_course = $this->common->getTableData($table);
			$user_course = !empty($user_course)?array_column($user_course,"iCourseId"):array();
		}


		$table = "course";
		$where = "iStatus = '1' AND dtDeletedAt IS NULL";
		$course_arr = $this->common->getTableData($table,$where);


		if(!empty($this->input->post())){
			if ($this->valid_user() == TRUE) {

				$name = $this->input->post('vName');
				$email = $this->input->post('vEmail');
				$phone_number = $this->input->post('phone_number');
				$courses = $this->input->post('course');

				$table = "users";

				$insert = array(
					"vName"=>$name,
					"vEmail"=>$email,
					"vUsername"=>$email,
					"vPhoneNumber"=>$phone_number,
					"iUserTypeId"=>2,
				);


				if(!empty($iUserId)){
					$where = "iUserId = '$iUserId'";
					$this->common->update($table,$insert,$where);
				}else{
					$iUserId = $this->common->insert($table,$insert);
					$where = "iUserId = '$iUserId'";
				}

				$table = "student_course_trance";
				$this->common->delete($table,$where);

				if(!empty($courses)){
					foreach ($courses as $key => $value) {
						$this->common->insert($table,array("iUserId"=>$iUserId,"iCourseId"=>$value));
					}
				}

				$this->session->set_flashdata("success","Student Save successfully");
				redirect('admin/users');
            }
		}

		$data['user'] = !empty($user)?$user[0]:NULL;
		$data['course_arr'] = !empty($course_arr)?$course_arr:NULL;
		$data['user_course'] = !empty($user_course)?$user_course:NULL;
		$data['view_name'] = 'add_student';
		$data['js_files'] = array('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js');
		$data['css_files'] = array('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');

		$this->load->view('template',$data);
	}

	public function delete_student($iUserId) {
		$table = "users";
		$where = "iUserId = '$iUserId'";

		$user = $this->common->update($table,array('dtDeletedAt'=>date('Y-m-d H:i:s')),$where);
		$this->session->set_flashdata("success","Student Deleted successfully");
		redirect('admin/users');
	}

	public function course() {
		$table = "course";
		$where = "dtDeletedAt IS NULL";

		$course = $this->common->getTableData($table,$where);

		$data['course'] = $course;
		$data['view_name'] = 'course';
		$data['js_files'] = array('https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js','https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js');
		$data['css_files'] = array('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css');

		$this->load->view('template',$data);
	}

	public function add_course($iCourseId = NULL) {
		$table = "course";
		$where = NULL;
		if(!empty($iCourseId)){
			$where = "iCourseId = '$iCourseId'";
			$course = $this->common->getTableData($table,$where);
		}


		if(!empty($this->input->post())){
			if ($this->valid_course() == TRUE) {

				$vCourse = $this->input->post('vCourse');
				$vProfessorName = $this->input->post('vProfessorName');
				$tDescription = $this->input->post('tDescription');

				$table = "course";

				$insert = array(
					"vCourse"=>$vCourse,
					"vProfessorName"=>$vProfessorName,
					"tDescription"=>$tDescription
				);


				if(!empty($iCourseId)){
					$where = "iCourseId = '$iCourseId'";
					$this->common->update($table,$insert,$where);
				}else{
					$iCourseId = $this->common->insert($table,$insert);
					$where = "iCourseId = '$iCourseId'";
				}

				$this->session->set_flashdata("success","Course Save successfully");
				redirect('admin/course');
            }
		}

		$data['course'] = !empty($course)?$course[0]:NULL;
		$data['view_name'] = 'add_course';

		$this->load->view('template',$data);
	}

	public function delete_course($icourseId) {
		$table = "course";
		$where = "icourseId = '$icourseId'";

		$course = $this->common->update($table,array('dtDeletedAt'=>date('Y-m-d H:i:s')),$where);
		$this->session->set_flashdata("success","Student Deleted successfully");
		redirect('admin/course');
	}

	private function valid_login(){

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		return $this->form_validation->run();
	}
	private function valid_user(){

		$this->form_validation->set_rules('vName', 'Name', 'required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('vEmail', 'Email Address', 'required|valid_email|is_unique[users.vEmail]|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|min_length[10]|max_length[10]');

		return $this->form_validation->run();
	}
	private function valid_course(){

		$this->form_validation->set_rules('vCourse', 'Course', 'required|is_unique[course.vCourse]|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('vProfessorName', 'Professor Name', 'required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('tDescription', 'Description', 'required');

		return $this->form_validation->run();
	}
}
