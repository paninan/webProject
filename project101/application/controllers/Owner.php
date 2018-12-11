<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	public function  __construct(){
		parent::__construct();

		$this->load->model('service_model');
		$this->load->model('beautician_model');
		$this->load->model('owner_model');

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

	public function beautician($beau_id=NULL)
	{   
		$data = array();
		$data['m_beautician'] = $this->beautician_model->read();

		if($beau_id!==NULL){
			$data['m_beautician_edit'] = $this->beautician_model->read($beau_id);
		}

		$this->load->view('v_owner_beautician',$data);
	}

	public function income()
	{   
		$data = array();
		$beau_id = NULL;
		$date = empty($date) ? date('Ymd') : $date;

		$data['m_income_daily'] = $this->owner_model->income_daily($beau_id,$date);
		$data['m_income_monthly'] = $this->owner_model->income_monthly($beau_id,$date);
		$data['m_sum_monthly'] = $this->owner_model->summary_beau_monthly($date);
		$data['m_service_monthly'] = $this->owner_model->group_service_monthly($beau_id,$date);
		

		$this->load->view('v_owner_income',$data);
	}

	public function service_deactive($service_id=NULL)
	{	
		$this->service_model->deactive($service_id);
		redirect('owner/service','refresh');

	}
	public function service_active($service_id=NULL)
	{	
		$this->service_model->active($service_id);
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

	public function add_beautician()
	{
		$data = array();
		$data['beau_name'] = $this->input->post('beau_name');
		$data['beau_lastname'] = $this->input->post('beau_lastname');
		$data['beau_address'] = $this->input->post('beau_address');
		$data['beau_gender'] = $this->input->post('beau_gender');
		$data['beau_email'] = $this->input->post('beau_email');
		$data['beau_password'] = $this->input->post('beau_password');
		$data['beau_phone'] = $this->input->post('beau_phone');

		$this->owner_model->add_beau($data);

		redirect('owner/beautician');
	}

	public function edit_beautician($beau_id=NULL)
	{
		// update data  if has summit send to post
		if( $this->input->post('beau_id')!== FALSE ){

			$data = array();
			$data['beau_name'] = $this->input->post('beau_name');
			$data['beau_lastname'] = $this->input->post('beau_lastname');
			$data['beau_address'] = $this->input->post('beau_address');
			$data['beau_gender'] = $this->input->post('beau_gender');
			$data['beau_email'] = $this->input->post('beau_email');
			$data['beau_password'] = $this->input->post('beau_password');
			$data['beau_phone'] = $this->input->post('beau_phone');

			$this->owner_model->update_beau($this->input->post('beau_id'),$data);

			redirect('owner/beautician/'.$this->input->post('beau_id'));
		}

		redirect('owner/beautician');
	}

	public function delete_beautician($beau_id=NULL)
	{
		if(empty($beau_id)){
			redirect('owner/beautician');
		}

		$this->owner_model->delete_beau($beau_id);

		redirect('owner/beautician');
	}

	
}
