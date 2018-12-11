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
		if($this->input->post ('customer_email') !== FALSE   && !empty($this->input->post ('customer_email')) ){
			$data['customer_name'] = $this->input->post('customer_name');
			$data['customer_nickname'] = $this->input->post('customer_nickname');
			$data['customer_email'] = trim($this->input->post('customer_email'));
			$data['customer_password'] = $this->input->post('customer_password');
			$data['customer_phone'] = $this->input->post('customer_phone');
			$data['customer_gender'] = $this->input->post('customer_gender');
			$this->customer_model->save($data);
		}

		redirect('auth/login');
	}

	
	
}
