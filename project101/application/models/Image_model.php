<?php
class Image_model extends CI_Model {

    function read(){
        $rs = $this->db->query('select * from images');
        return $rs;
    }

}
