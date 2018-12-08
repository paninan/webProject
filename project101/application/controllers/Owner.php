<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	public function  __construct(){
		parent::__construct();

		$this->load->model('service_model');
		$this->load->model('beautician_model');

		if( !$this->session->userdata('is_owner')  ){
			// show_error( "no privilage access !!! ~_~?...",203,"Access message");
			redirect('auth/login');
		}
	}

	public function index(){
		redirect('owner/service','refresh');
	}

	public function service()
	{   
		$data = array();
		$data['m_service_all'] = $this->service_model->readall();
		$data['m_service_type'] = $this->service_model->read_type();
		
		
		$this->load->view('v_owner_service',$data);
	}

	public function beautician()
	{   
		$data = array();
		$data['m_beautician'] = $this->beautician_model->read();
		$this->load->view('v_owner_beautician',$data);
	}

	public function income()
	{   
		$data = array();
		$this->load->view('v_owner_income',$data);
	}

	public function service_deactive($service_id=NULL)
	{	
		$this->service_model->deactive($service_id);
		redirect('owner/service','refresh');

	}

	public function add_service()
	{
		$data = array();
		$data['service_name'] = $this->input->post('service_name');	
		$data['service_type_id'] = $this->input->post('service_type');	
		$data['service_time'] = $this->input->post('service_time');	
		$data['service_price'] = $this->input->post('service_price');	
		$data['service_img'] = $this->input->post('service_img');
		$data['service_description'] = $this->input->post('service_description');	

		$this->service_model->save($data);

		redirect('owner/service');
	}

	
}
