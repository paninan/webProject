<?php
class Owner_model extends CI_Model {

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

    public function income_daily($beau_id=NULL,$date=NULL){

        $sql = "";
        $where = "";
        $wheres = array();


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
        ,p.payment_total_price
        ,DATE_FORMAT(r.start_time,'%Y%m%d') as _date
        ,count(*) as cnt_job
        ,FLOOR(sum(p.payment_total_price)) as total
        ,FLOOR(sum(p.payment_total_price)) * ? as owner_commission
        ,FLOOR(sum(p.payment_total_price)) * ? as beautician_commission
        from reservations r
        inner join services s on s.service_id = r.service_id
        inner join beauticians b on b.`beau_id` = r.beau_id
        inner join payments p on p.payment_reser_id=r.reser_id
    
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
        ,p.payment_total_price
        ,DATE_FORMAT(r.start_time,'%Y%m') as _date
        ,count(*) as cnt_job
        ,FLOOR(sum(p.payment_total_price)) as total
        ,FLOOR(sum(p.payment_total_price)) * ? as owner_commission
        ,FLOOR(sum(p.payment_total_price)) * ? as beautician_commission
        from reservations r
        inner join services s on s.service_id = r.service_id
        inner join beauticians b on b.`beau_id` = r.beau_id
        inner join payments p on p.payment_reser_id=r.reser_id
        where ".implode(" AND ",$wheres)."
        group by _date
        ";


        $rs = $this->db->query($sql,array(
            self::COMMISION_OWNER ,
            self::COMMISION_BEAUTICAIN 
        ));
        
        return $rs;

    }

    public function summary_beau_monthly($date=NULL){

        $sql = "";
        $where = "";
        $wheres = array();


        if (!is_null($date)){
            array_push($wheres," DATE_FORMAT(r.start_time,'%Y%m')= '".date('Ym',strtotime($date) ) ."'");
        }

        array_push($wheres," r.status = '".self::STATUS_CONFIRM."'");
        array_push($wheres," r.pay = 1");

        $sql = "
        select 
        r.start_time
        ,r.end_time
        ,b.beau_id
        ,b.beau_name
        ,b.beau_email
        ,s.service_id
        ,s.service_price
        ,p.payment_total_price
        ,DATE_FORMAT(r.start_time,'%Y%m') as _month
        ,count(*) as cnt_job
        ,FLOOR(sum(p.payment_total_price)) as total
        ,FLOOR(sum(p.payment_total_price)) * ? as owner_commission
        ,FLOOR(sum(p.payment_total_price)) * ? as beautician_commission
        from reservations r
        inner join services s on s.service_id = r.service_id
        inner join beauticians b on b.`beau_id` = r.beau_id
        inner join payments p on p.payment_reser_id=r.reser_id
        where ".implode(" AND ",$wheres)."
        group by _month,b.beau_id
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
        ,p.payment_total_price
        ,DATE_FORMAT(r.start_time,'%Y%m') as _date
        ,count(*) as cnt_service
        ,FLOOR(sum(p.payment_total_price)) as total
        ,FLOOR(sum(p.payment_total_price)) * ? as owner_commission
        ,FLOOR(sum(p.payment_total_price)) * ? as beautician_commission
        from reservations r
        inner join services s on s.service_id = r.service_id
        inner join beauticians b on b.`beau_id` = r.beau_id
        inner join payments p on p.payment_reser_id=r.reser_id
        where ".implode(" AND ",$wheres)."
        group by s.service_id
        ";

        $rs = $this->db->query($sql,array(
            self::COMMISION_OWNER ,
            self::COMMISION_BEAUTICAIN 
        ));
        
        return $rs;

    }

    public function add_beau($data = NULL)
    {
        if (empty($data) ){
            return FALSE;
        }

        $this->db->insert('beauticians',$data);

        return $this->db->affected_rows();

    }

    public function update_beau($beau_id , $data)
    {
        if (empty($data) ){
            return FALSE;
        }
        // $this->db->set('beau_name',$this->data['beau_name']);
        // $this->db->set('beau_lastname',$this->data['beau_lastname']);
        // $this->db->set('beau_address',$this->data['beau_address']);
        // $this->db->set('beau_gender',$this->data['beau_gender']);
        // $this->db->set('beau_email',$this->data['beau_email']);
        // $this->db->set('beau_password',$this->data['beau_password']);
        // $this->db->set('beau_phone',$this->data['beau_phone']);
        // $this->db->set('beau_position',$this->data['beau_position']);
        $this->db->where('beau_id',$beau_id);
        $this->db->update('beauticians',$data);
        return $this->db->affected_rows();
        
    }

    public function delete_beau($beau_id =NULL)
    {
        if (empty($beau_id) ){
            return FALSE;
        }

        $this->db->where('beau_id',$beau_id);
        $this->db->delete('beauticians');
        return $this->db->affected_rows();
    }
}
