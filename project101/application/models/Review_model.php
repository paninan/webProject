<?php
class Review_model extends CI_Model {

    function read($service_id=NULL){

        if($service_id == NULL){
            $sql = "select * from reviews";
        }

        if($service_id != NULL){
            $sql = "select * from reviews where service_id = ".$service_id;
        }

        $rs = $this->db->query($sql);

        return $rs;
    }


    // function read_by_id($service_id=NULL){
    //     $rs = $this->db->query('
    //     select * from reviews where service_id = '.$service_id);
    //     return $rs;
    // }

}
