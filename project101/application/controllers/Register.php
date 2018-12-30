<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function  __construct(){
		parent::__construct();

		$this->load->model('customer_model');

	}

	public function index()
	{  
		$data['m_customer'] = $this->customer_model->read();
		$this->load->view('v_register',$data);
	}

	public function add()
	{
		if($this->input->post ('user_email') !== FALSE   && !empty($this->input->post ('user_email')) ){
			$data['user_firstname'] = $this->input->post('user_firstname');
			$data['user_nickname'] = $this->input->post('user_nickname');
			$data['user_email'] = trim($this->input->post('user_email'));
			$data['user_password'] = $this->input->post('user_password');
			$data['user_phone'] = $this->input->post('user_phone');
			$data['user_gender'] = $this->input->post('user_gender');
			$this->customer_model->save($data);
		}

		redirect('auth/login');
	}

	
	
}
