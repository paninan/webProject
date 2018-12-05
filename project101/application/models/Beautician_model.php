<?php
class Beautician_model extends CI_Model {

    function read($id = NULL )
    {
        if (!is_null($id)){
            $rs = $this->db->query("select * from beauticians where beau_id = ? ",array($id));
        }else{
            $rs = $this->db->query('select * from beauticians ');
        }
        
        return $rs;
    }

    function write(){

    }

    function update(){

    }

    function delete(){
        
    }


    function check_available($bid=NULL,$service_id=NULL,$resv_time=NULL){

        $sql = "
        select *
        from reservations
        where 1=1
        -- and service_id = ".$service_id."
        and beau_id = ".$bid."
        and '".$resv_time."' between start_time and end_time
        and status IN ('WAITING','CONFIRM')
        ";
        
        $rs = $this->db->query($sql);
        return $rs;

    }

        

}
