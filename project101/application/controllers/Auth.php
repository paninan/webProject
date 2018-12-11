<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    private $is_beauticians = FALSE;
    private $is_owner = FALSE;
    private $is_customer = FALSE;

    public function __construct(){
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
    }

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
            $passwd = $this->input->post('password');
            $type = $this->input->post('login_type');

            if($type == "member"){
                $ret = $this->_login_customer($email,$passwd);
                if( $ret === TRUE){
                    $this->session->set_userdata('logged_in',TRUE);
                }
            }elseif($type == "beautician"){
                $ret = $this->_login_beauticians($email,$passwd);
                if( $ret === TRUE){
                    $this->session->set_userdata('logged_in',TRUE);
                }
            }elseif($type =="owner"){
                $ret = $this->_login_owner($email,$passwd);
                if( $ret === TRUE){
                    $this->session->set_userdata('logged_in',TRUE);
                }
            }else{
                $this->session->set_userdata('logged_in',FALSE);
            }

            // // regular expression validate
            // if( preg_match('/^beautician.+/',$email) ){
            //     $email = str_replace('beautician.','',$email);
            //     $ret = $this->_login_beauticians($email,$passwd);
            //     if( $ret === TRUE){
            //         $this->session->set_userdata('logged_in',TRUE);
            //     }
            // }else if( preg_match('/^owner.+/',$email) ){
            //     $email = str_replace('owner.','',$email);
            //     // $email = preg_replace('/(^owner\.$).(\w+)/i', '$2', $email);
            //     $ret = $this->_login_owner($email,$passwd);
            //     if( $ret === TRUE){
            //         $this->session->set_userdata('logged_in',TRUE);
            //     }
            // }else{
            //     $ret = $this->_login_customer($email,$passwd);
            //     if( $ret === TRUE){
            //         $this->session->set_userdata('logged_in',TRUE);
            //     }
            // }

            if($ret === FALSE ){
                redirect('auth/login');
            }else{
                redirect('home/index','refresh');
            }
        }else{

            redirect('auth/login');

        }
        
    }
    
    public function logout()
	{
        $this->session->sess_destroy();
		redirect('auth/login');
    }
    
    private function _login_customer($email,$passwd){

        $rs = $this->db->query("select * from customers where customer_email like ? and customer_password like ? ",
            array($email,$passwd)
        );

        if ( $rs->num_rows() !== 0 ){
            
            // set settion
            $this->_login_customer = TRUE;
            
            $this->session->set_userdata('is_customer',TRUE);
            $this->session->set_userdata('user_id',$rs->row(0)->customer_id);
            $this->session->set_userdata('user_name',$rs->row(0)->customer_name);
            $this->session->set_userdata('user_gender',$rs->row(0)->customer_gender);
            $this->session->set_userdata('user_email',$rs->row(0)->customer_email);
            $this->session->set_userdata('user_phone',$rs->row(0)->customer_phone);
            
            return TRUE;
        }
        return FALSE;
    }

    private function _login_beauticians($email,$passwd){

        $rs = $this->db->query("select * from beauticians where beau_email like ? and beau_password like ? ",
            array($email,$passwd)
        );

        if ( $rs->num_rows() !== 0 ){
            $this->_login_beauticians = TRUE;
            $this->session->set_userdata('is_beautician',TRUE);
            $this->session->set_userdata('user_id',$rs->row(0)->beau_id);
            $this->session->set_userdata('user_name',$rs->row(0)->beau_name);
            $this->session->set_userdata('user_gender',$rs->row(0)->beau_gender);
            $this->session->set_userdata('user_email',$rs->row(0)->beau_email);
            $this->session->set_userdata('user_phone',$rs->row(0)->beau_phone);
            $this->session->set_userdata('user_position',$rs->row(0)->beau_position);
            return TRUE;
        }

        return FALSE;
        
    }

    private function _login_owner($email,$passwd){
        // echo $email;
        // echo $passwd;
        // exit();
        $fix_email  = "waan@mail.com";
        $fix_passwd = "123456";
        $is_auth    = FALSE;

        if ( ($email == $fix_email ) && ($passwd == $fix_passwd) ){
            $is_auth = TRUE;
        }

        if ( $is_auth ){
            
            $this->_login_owner = TRUE;
            $this->session->set_userdata('is_owner',TRUE);
            $this->session->set_userdata('user_id','0');
            $this->session->set_userdata('user_name',$fix_email);
            $this->session->set_userdata('user_gender','W');
            $this->session->set_userdata('user_email',$fix_email);
            $this->session->set_userdata('user_phone', '094');
            $this->session->set_userdata('user_position','Owner');
            return TRUE;
        }

        return FALSE;

    }
	
}
