<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function index()
	{        
		$this->load->model('review_model');		
		$data['m_review'] = $this->review_model->read();

		$this->load->view('v_review',$data);

	}

	public function service($id=NULL)
	{ 
		$this->load->model('review_model');	
		$data['m_review'] = $this->review_model->read($id);      
		$this->load->view('v_review_write',$data);


	}

	

	
}
