<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

	public function  __construct(){
		parent::__construct();

		$this->load->model('service_model');
		$this->load->model('beautician_model');
	}

	public function index()
	{        

		$this->load->model('service_model');		
		$data['m_service'] = $this->service_model->read();

		$this->load->view('v_service',$data);

	}
	public function reservations($id=NULL,$has_date=NULL)
	{         
		$data = array();

		$data['has_date']  = $has_date == NULL ? date('Y-m-d') : $has_date;
		$data['has_service'] = $id;
		$data['services'] = $this->service_model->read();
		$data['beauticians'] = $this->beautician_model->read();

		$this->load->view('v_reservations',$data);

	}

	public function book($service_id=NULL,$beaucian_id=NULL,$start_dt=NULL){

		$data = array();

		// get service time
		$rw = $this->service_model->read($service_id);
		$service = $rw->row(0);

		// get user 0->guest || -> member
		$user = 0;

		if($this->input->post('email') !== FALSE  && !empty($this->input->post('email') ) ){
			$end_dt  = ($start_dt + ($service->service_time * 60) ) -1 ;
			$msg = $this->input->post('message');
			$telephone = $this->input->post('telephone');
			$email = $this->input->post('email');
			// save booking into model service_model
			$this->service_model->booking(
				$user,
				$service_id,
				$beaucian_id,
				date('Y-m-d H:i:s',$start_dt),
				date('Y-m-d H:i:s',$end_dt),
				$msg,
				$telephone,
				$email
			);

			redirect("service/reservations/{$service_id}/".date('Y-m-d',$start_dt));
		}

		$data['has_service'] = $service_id;
		$data['services'] = $service;
		$data['beauticians'] = $this->beautician_model->read();

		$this->load->view('v_booking',$data);
	}

	
}
