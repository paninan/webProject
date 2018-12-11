<?php
class Customer_model extends CI_Model {
    
    function save($data)
    {
        if(empty($data)){
            return FALSE;
        }

        $this->db->insert('customers', $data);
        return $this->db->affected_rows();
    }

    function read()
    {
        return $this->db->get('customers');
    }

}
