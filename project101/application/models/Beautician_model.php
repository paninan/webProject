<?php
class Beautician_model extends CI_Model {

    const STATUS_WAIT = "WAITING";
    const STATUS_CONFIRM = "CONFIRM";
    const STATUS_REJECT = "REJECT";
    const COMMISION_OWNER = .55;
    const COMMISION_BEAUTICAIN = .45;

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

    function tasks($beau_id=NULL,$status=NULL){
        
        $sql = "";
        $where = "";
        $wheres = array();

        if (!is_null($beau_id)){
            array_push($wheres," r.beau_id = '".$beau_id."'");
        }

        if (!is_null($status)){
            array_push($wheres," r.status = '".strtoupper($status)."'");
        }

        // array_push($wheres," r.status = '".Beautician_model::STATUS_WAIT."'");

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

        if( strtoupper($status) == Beautician_model::STATUS_CONFIRM){
            $this->db->where('reser_id',$reser_id);
            $this->db->set('status',Beautician_model::STATUS_CONFIRM);
            $this->db->update('reservations');

        }

        if( strtoupper($status) == Beautician_model::STATUS_REJECT){
            $this->db->where('reser_id',$reser_id);
            $this->db->set('status',Beautician_model::STATUS_REJECT);
            $this->db->update('reservations');
        }


        if( strtoupper($status) == Beautician_model::STATUS_WAIT){
            $this->db->where('reser_id',$reser_id);
            $this->db->set('status',Beautician_model::STATUS_WAIT);
            $this->db->update('reservations');
        }

    }

    public function pay($reser_id){
        $this->db->where('reser_id',$reser_id);
        $this->db->set('pay',1);
        $this->db->update('reservations');
            
        if ($this->db->affected_rows() > 0 ){
            $q = $this->db->get_where('reservations', array('reser_id' => $reser_id));
            foreach( $q->result() as $row ) {
                $this->db->query("
                UPDATE customers
                SET customer_point = customer_point + 1
                WHERE customer_id = ? ",array($row->customer_id)
                );
            }
        }
    }


    public function income_daily($beau_id=NULL,$date=NULL){

        $sql = "";
        $where = "";
        $wheres = array();

        if (!is_null($beau_id)){
            array_push($wheres," r.beau_id = '".$beau_id."'");
        }

        if (!is_null($date)){
            array_push($wheres," DATE_FORMAT(r.start_time,'%Y%m%d')= '".date('Ymd',strtotime($date) ) ."'");
        }

        array_push($wheres," r.status = '".self::STATUS_CONFIRM."'");
        array_push($wheres," r.pay = 1");

        $sql = "
        select 
        r.start_time
        ,r.end_time
        ,r.beau_id
        ,b.beau_name
        ,s.service_id
        ,s.service_price
        ,DATE_FORMAT(r.start_time,'%Y%m%d') as _date
        ,count(*) as cnt_job
        ,sum(s.service_price) as total
        ,sum(s.service_price) * ? as owner_commission
        ,sum(s.service_price) * ? as beautician_commission
        from reservations r
        inner join services s on s.service_id = r.service_id
        inner join beauticians b on b.`beau_id` = r.beau_id
        where ".implode(" AND ",$wheres)."
        group by _date
        ";


        $rs = $this->db->query($sql,array(
            self::COMMISION_OWNER ,
            self::COMMISION_BEAUTICAIN 
        ));

        return $rs;

    }

    public function income_monthly($beau_id=NULL,$date=NULL){

        $sql = "";
        $where = "";
        $wheres = array();

        if (!is_null($beau_id)){
            array_push($wheres," r.beau_id = '".$beau_id."'");
        }

        if (!is_null($date)){
            array_push($wheres," DATE_FORMAT(r.start_time,'%Y%m')= '".date('Ym',strtotime($date) ) ."'");
        }

        array_push($wheres," r.status = '".self::STATUS_CONFIRM."'");
        array_push($wheres," r.pay = 1");

        $sql = "
        select 
        r.start_time
        ,r.end_time
        ,r.beau_id
        ,b.beau_name
        ,s.service_id
        ,s.service_price
        ,DATE_FORMAT(r.start_time,'%Y%m') as _date
        ,count(*) as cnt_job
        ,sum(s.service_price) as total
        ,sum(s.service_price) * ? as owner_commission
        ,sum(s.service_price) * ? as beautician_commission
        from reservations r
        inner join services s on s.service_id = r.service_id
        inner join beauticians b on b.`beau_id` = r.beau_id
        where ".implode(" AND ",$wheres)."
        group by _date
        ";


        $rs = $this->db->query($sql,array(
            self::COMMISION_OWNER ,
            self::COMMISION_BEAUTICAIN 
        ));
        
        return $rs;

    }

    public function group_service_monthly($beau_id=NULL,$date=NULL){

        $sql = "";
        $where = "";
        $wheres = array();

        if (!is_null($beau_id)){
            array_push($wheres," r.beau_id = '".$beau_id."'");
        }

        if (!is_null($date)){
            array_push($wheres," DATE_FORMAT(r.start_time,'%Y%m')= '".date('Ym',strtotime($date) ) ."'");
        }

        array_push($wheres," r.status = '".self::STATUS_CONFIRM."'");
        array_push($wheres," r.pay = 1");

        $sql = "
        select 
        r.start_time
        ,r.end_time
        ,r.beau_id
        ,b.beau_name
        ,s.service_id
        ,s.service_name
        ,s.service_price
        ,DATE_FORMAT(r.start_time,'%Y%m') as _date
        ,count(*) as cnt_service
        ,sum(s.service_price) as total
        ,sum(s.service_price) * ? as owner_commission
        ,sum(s.service_price) * ? as beautician_commission
        from reservations r
        inner join services s on s.service_id = r.service_id
        inner join beauticians b on b.`beau_id` = r.beau_id
        where ".implode(" AND ",$wheres)."
        group by s.service_id
        ";

        $rs = $this->db->query($sql,array(
            self::COMMISION_OWNER ,
            self::COMMISION_BEAUTICAIN 
        ));
        
        return $rs;

    }

        

}
