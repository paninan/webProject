<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beautician extends CI_Controller {

	public function  __construct(){
		parent::__construct();

		$this->load->model('service_model');
		$this->load->model('beautician_model');

		if( !$this->session->userdata('is_beautician')  ){
			show_error( "no privilage access !!! ~_~?...",203,"Access message");
		}
	}

	public function index()
	{   
		redirect('beautician/jobs/waiting');
	}

	public function jobs($status='waiting')
	{
		$beau_id = $this->session->userdata('user_id');
		$data['m_status']		= $status;
		$data['m_beauti_task'] 	= $this->beautician_model->tasks($beau_id,$status);
		$this->load->view('v_beautician_jobs',$data);
	}

	public function confirm($reser_id=NULL)
	{
		$this->beautician_model->task_status($reser_id,Beautician_model::STATUS_CONFIRM);
		redirect('beautician','refresh');
	}

	public function reject($reser_id=NULL)
	{
		$this->beautician_model->task_status($reser_id,Beautician_model::STATUS_REJECT);
		redirect('beautician','refresh');
	}

	public function pay($reser_id=NULL)
	{
		$this->beautician_model->pay($reser_id);
		redirect('beautician/confirm','refresh');
	}
	
	public function income($date=NULL){
		$data = array();
		$beau_id = $this->session->userdata('user_id');
		$date = empty($date) ? date('Ymd') : $date;

		$data['m_income_daily'] = $this->beautician_model->income_daily($beau_id,$date);
		$data['m_income_monthly'] = $this->beautician_model->income_monthly($beau_id,$date);
		$data['m_service_monthly'] = $this->beautician_model->group_service_monthly($beau_id,$date);
		
		$this->load->view('v_beautician_income',$data);
	}

	
}
