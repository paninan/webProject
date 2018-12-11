<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function index()
	{        
		$this->load->model('review_model');		
		$data['m_review'] = $this->review_model->count_review();
		$this->load->view('v_review',$data);

	}

	public function service($id=NULL)
	{ 
		$this->load->model('review_model');	
		$data['m_review'] = $this->review_model->read($id);      
		$this->load->view('v_review_write',$data);


	}

	public function read($service_id = NULL)
	{
		// save 
		if($this->input->post('message') !== FALSE &&  !empty($this->input->post('message')) ){
			
			$name = $this->input->post('name');
			$message = $this->input->post('message');
			$this->load->model('review_model');	
			$this->review_model->post_message($name,$message,$service_id);
		}

		$this->load->model('review_model');		
		$data['m_review'] = $this->review_model->read($service_id);
		$this->load->view('v_review_write',$data);

	}

	

	
}
