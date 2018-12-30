<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	public function  __construct(){
		parent::__construct();

		$this->load->model('service_model');
		$this->load->model('beautician_model');
		$this->load->model('owner_model');
		$this->load->model('customer_model');

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
		// var_dump($data);

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
		$data['user_firstname'] = $this->input->post('user_firstname');
		$data['user_lastname'] = $this->input->post('user_lastname');
		$data['user_address'] = $this->input->post('user_address');
		$data['user_gender'] = $this->input->post('user_gender');
		$data['user_email'] = $this->input->post('user_email');
		$data['user_password'] = $this->input->post('user_password');
		$data['user_phone'] = $this->input->post('user_phone');
		$data['user_type'] = 'beautician';

		// upload image
		$img = $this->customer_model->upload_picture('picture');
		if( !empty($img['upload_data']['image_url']) ){
			$data['user_picture'] = $img['upload_data']['image_url'];
		}

		$this->owner_model->add_beau($data);
		redirect('owner/beautician');
	}

	public function edit_beautician($user_id=NULL)
	{
		// update data  if has summit send to post
		if( $this->input->post('user_id')!== FALSE ){

			$data = array();
			$data['user_firstname'] = $this->input->post('user_firstname');
			$data['user_lastname'] = $this->input->post('user_lastname');
			$data['user_address'] = $this->input->post('user_address');
			$data['user_gender'] = $this->input->post('user_gender');
			$data['user_email'] = $this->input->post('user_email');
			$data['user_password'] = $this->input->post('user_password');
			$data['user_phone'] = $this->input->post('user_phone');

			// upload image
			$img = $this->customer_model->upload_picture('picture');
			if( !empty($img['upload_data']['image_url']) ){
				$data['user_picture'] = $img['upload_data']['image_url'];
			}

			$this->owner_model->update_beau($this->input->post('user_id'),$data);

			redirect('owner/beautician/'.$this->input->post('user_id'));
		}

		redirect('owner/beautician');
	}

	public function delete_beautician($user_id=NULL)
	{
		if(empty($user_id)){
			redirect('owner/beautician');
		}

		$this->owner_model->delete_beau($user_id);

		redirect('owner/beautician');
	}

	
}
