<?php
class Owner_model extends CI_Model {

    const STATUS_WAIT = "WAITING";
    const STATUS_CONFIRM = "CONFIRM";
    const STATUS_REJECT = "REJECT";
    const COMMISION_OWNER = .80;
    const COMMISION_BEAUTICAIN = .20;

    function read($id = NULL )
    {
        if (!is_null($id)){
            $rs = $this->db->query("select * from users where user_id = ? and user_type = 'beautician'",array($id));
        }else{
            $rs = $this->db->query('select * from users where user_type = \'beautician\'');
        }
        
        return $rs;
    }

    function write(){

    }

    function update(){

    }

    function delete(){
        
    }

    public function income_daily($user_id=NULL,$date=NULL){

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
        ,b.user_firstname
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
        inner join users b on ( b.`user_id` = r.beau_id AND b.user_type = 'beautician' )
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

    public function income_monthly($user_id=NULL,$date=NULL){

        $sql = "";
        $where = "";
        $wheres = array();

        if (!is_null($user_id)){
            array_push($wheres," r.beau_id = '".$user_id."'");
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
        ,b.user_firstname
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
        inner join users b on ( b.`user_id` = r.beau_id AND b.user_type = 'beautician' )
        inner join payments p on p.payment_reser_id=r.reser_id
        where ".implode(" AND ",$wheres)."
        group by _date
        ";


        $rs = $this->db->query($sql,array(
            self::COMMISION_OWNER ,
            self::COMMISION_BEAUTICAIN 
        ));

        // echo $this->db->last_query();
        
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
        ,b.user_id
        ,b.user_firstname
        ,b.user_email
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
        inner join users b on ( b.`user_id` = r.beau_id AND b.user_type = 'beautician' )
        inner join payments p on p.payment_reser_id=r.reser_id
        where ".implode(" AND ",$wheres)."
        group by _month,b.user_id
        ";


        $rs = $this->db->query($sql,array(
            self::COMMISION_OWNER ,
            self::COMMISION_BEAUTICAIN 
        ));
        
        return $rs;

    }

    public function group_service_monthly($user_id=NULL,$date=NULL){

        $sql = "";
        $where = "";
        $wheres = array();

        if (!is_null($user_id)){
            array_push($wheres," r.beau_id = '".$user_id."'");
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
        ,b.user_firstname
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
        inner join users b on ( b.`user_id` = r.beau_id AND b.user_type = 'beautician' )
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

        $this->db->insert('users',$data);

        return $this->db->affected_rows();

    }

    public function update_beau($user_id , $data)
    {
        if (empty($data) ){
            return FALSE;
        }
        // $this->db->set('user_firstname',$this->data['user_firstname']);
        // $this->db->set('beau_lastname',$this->data['beau_lastname']);
        // $this->db->set('beau_address',$this->data['beau_address']);
        // $this->db->set('beau_gender',$this->data['beau_gender']);
        // $this->db->set('user_email',$this->data['user_email']);
        // $this->db->set('beau_password',$this->data['beau_password']);
        // $this->db->set('beau_phone',$this->data['beau_phone']);
        // $this->db->set('beau_position',$this->data['beau_position']);
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
        return $this->db->affected_rows();
        
    }

    public function delete_beau($user_id =NULL)
    {
        if (empty($user_id) ){
            return FALSE;
        }
        
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('users');

        $row_affected = 0;
        foreach ($query->result() as $row){
            $this->db->where('user_id',$row->user_id);
            $this->db->delete('users');
            $row_affected += $this->db->affected_rows();

            if( $row_affected > 0 ){
                $path = FCPATH.$row->user_picture;
                unlink($path);
            }
            
        }
        
        return $row_affected;
    }
}
