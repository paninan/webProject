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
		$beau_id = $this->session->userdata('user_id');
		$data['m_beauti_task'] = $this->beautician_model->task_waiting($beau_id);
		$this->load->view('v_beautician',$data);

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
	

	
}
