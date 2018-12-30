<?php
class Review_model extends CI_Model {

    function read($service_id=NULL){

        $wheres = array();

        array_push($wheres," 1 = 1");
        if($service_id != NULL){
            array_push($wheres,"s.service_id = ".$service_id);
        }

        $str_where = implode(" AND ",$wheres);

        $sql = "
        SELECT 
        r.* 
        ,s.service_name
        ,s.service_img
        ,s.service_description
        ,s.service_price
        ,s.service_id
        FROM reviews r
        RIGHT JOIN services s on r.`service_id` = s.`service_id`
        WHERE 
        {$str_where}
        ORDER BY r.review_date DESC
        ";

        $rs = $this->db->query($sql);

        return $rs;

    }

    function count_review($service_id=NULL){

        $wheres = array();
        array_push($wheres," 1 = 1");
        if($service_id != NULL){
            array_push($wheres,"r.service_id = ".$service_id);
        }
        
        $str_where = implode(" AND ",$wheres);

        $sql = "
        SELECT 
        r.* 
        ,count(r.review_id) as cnt_review
        ,max(r.review_date) as last_review
        ,s.service_name
        ,s.service_img
        ,s.service_id
        FROM services s
        LEFT JOIN reviews r on r.`service_id` = s.`service_id`
        WHERE 
        {$str_where}
        GROUP BY s.service_id
        ORDER BY r.review_date DESC";

        $rs = $this->db->query($sql);

        return $rs;
    }


    public function post_message($name=NULL,$message=NULL,$service=NULL){

        $data = array(
                'review_name' => $name,
                'review_message' => $message,
                'review_date' => date('Y-m-d H:i:s'),
                'service_id' => $service,
        );
        
        $this->db->insert('reviews', $data);
        return $this->db->affected_rows();

    }


    // function read_by_id($service_id=NULL){
    //     $rs = $this->db->query('
    //     select * from reviews where service_id = '.$service_id);
    //     return $rs;
    // }

}
