<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

	private $CI;
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->checkAuth();
	}

	public function checkAuth() {
		$method_exclude = array(
			'welcome'=>array('index'),
			'errorCode'=>array('error_400'),
			'admin'=>array('login')
		);

		if(empty($method_exclude) || empty($method_exclude[$this->CI->router->fetch_class()]) || !in_array($this->CI->router->fetch_method(), $method_exclude[$this->CI->router->fetch_class()])){
			if(empty($this->CI->session->userdata('user_id'))){
				echo "
					<script>
						window.location.href = '".base_url()."admin/login';
					</script>
				";die;
			}
		}
	}
}