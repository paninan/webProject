<?php
class Service_model extends CI_Model {

    const STATUS_WAIT = "WAITING";
    const STATUS_CONFIRM = "CONFIRM";
    const STATUS_REJECT = "REJECT";

    function read( $id=NULL ){
        if(!is_null($id) ) 
        {
            $rs = $this->db->query("select * from services where service_id = ? ",array($id));
        }
        else
        {
            $rs = $this->db->query('select * from services');
        }
        
        return $rs;
    }

    function booking($user=0, $service_id=NULL, $beaucian_id=NULL, $start_datetime=NULL,$end_datetime,$msg=NULL,$telephone=NULL,$email=NULL){

        $data = array(
            'service_id' => $service_id,
            'customer_id' => $user,
            'beau_id' => $beaucian_id,
            'register_time' =>  date('Y-m-d H:i:s'),
            'start_time' => $start_datetime,
            'end_time' => $end_datetime,
            'status' => Service_model::STATUS_WAIT,
            'message' => $msg,
            'telephone' => $telephone,
            'email' => $email
        );
    
        return $this->db->insert('reservations', $data);
    }

}
