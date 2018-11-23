<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{        
		redirect('auth/login');
    }
    
    public function login()
	{        
        $this->load->view('v_login');
    }

    public function chk_login(){

        if( $this->input->post('email') !== FALSE ){
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $rs = $this->db->query("select * from customers where customer_email like ? and customer_password like ? ",
                array($email,$password)
            );

            if ( $rs->num_rows() == 0 ){
                echo "Login Fail";
            }else{
                echo "Login Pass";
            }

        }else{

            redirect('auth/login');

        }
        
    }
    
    public function logout()
	{
		echo "logout";
	}
	
}
