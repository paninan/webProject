<?php
class Customer_model extends CI_Model {

    private $dir_upload = "";

    public function  __construct(){
        parent::__construct();

        $this->dir_upload = FCPATH."upload".DIRECTORY_SEPARATOR."picture".DIRECTORY_SEPARATOR;
    }
    
    function save($data)
    {
        if(empty($data)){
            return FALSE;
        }
        $data['user_type'] = 'customer';
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    function read()
    {
        $this->db->where('user_type','customer');
        return $this->db->get('users');
    }


    function upload_picture($filename='userfile')
    {
        $data      = array();
        $dir_date  = date('Ymd');

        if (empty($_FILES[$filename]['name'])) {
            return $data;   
        }
        
        if (!file_exists($this->dir_upload.$dir_date)) {
            mkdir($this->dir_upload.$dir_date, 0777, true);
        }

        $config['upload_path']          = $this->dir_upload.$dir_date ;
        $config['allowed_types']        = 'gif|jpg|jepg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 1024;
        $config['max_height']           = 1024;
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($filename))
        {
            $error = array('error' => $this->upload->display_errors());
            show_error($error);
            // var_dump($error);
            // $this->load->view('upload_form', $error);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
                $data['upload_data']['image_url'] =  str_replace(FCPATH,"",$data['upload_data']['full_path']);
                // $this->load->view('upload_success', $data);
        }

        return $data;

    }

}
