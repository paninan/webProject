<?php
class Beautician_model extends CI_Model {

    const STATUS_WAIT = "WAITING";
    const STATUS_CONFIRM = "CONFIRM";
    const STATUS_REJECT = "REJECT";

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

    function task_waiting($beau_id=NULL){
        
        $sql = "";
        $where = "";
        $wheres = array();

        if (!is_null($beau_id)){
            array_push($wheres," r.beau_id = '".$beau_id."'");
        }

        array_push($wheres," r.status = '".Beautician_model::STATUS_WAIT."'");

        $sql = "
        select 
        r.*  
        ,c.*
        ,s.*
        ,if(r.customer_id = 0 ,'Guest',c.customer_name) `customer_name`
        ,if(r.customer_id = 0 ,r.email,r.email) `contact_email`
        ,IFNULL(r.telephone ,'-') `telephone`
        ,IFNULL(r.message ,'-') `message`
        from reservations r
        left join customers c on r.`customer_id` = c.`customer_id`
        left join services s on  r.`service_id` = s.`service_id`
        where ".implode(" AND ",$wheres)." 
        order by r.start_time desc";


        $rs = $this->db->query($sql);
        return $rs;

    }

    public function task_status($reser_id,$status){

        if($status == Beautician_model::STATUS_CONFIRM){
            $this->db->where('reser_id',$reser_id);
            $this->db->set('status',Beautician_model::STATUS_CONFIRM);
            $this->db->update('reservations');

        }

        if($status == Beautician_model::STATUS_REJECT){
            // $this->db->where('reser_id',$reser_id);
            // $this->db->delete('reservations');
            $this->db->where('reser_id',$reser_id);
            $this->db->set('status',Beautician_model::STATUS_REJECT);
            $this->db->update('reservations');
        }

    }

        

}
