

<?php 
if( ( $this->session->userdata('logged_in') === TRUE) && ($this->session->userdata('is_beautician') === TRUE  ) ):
?>

<div class="nav-scroller bg-white box-shadow">
    <div class="container">
    <nav class="nav nav-underline">
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="jobs" ? "active" : "" );?>" href="<?php echo site_url('beautician/jobs');?>">
            งาน
                <?php 
                $v_rs = $this->beautician_model->tasks($this->session->userdata('user_id'),'waiting');
                if ($v_rs->num_rows() > 0 ){
                    echo '<span class="badge badge-pill badge-danger align-text-bottom">';
                    echo $v_rs->num_rows();
                    echo '</span>';
                }
                ?>
            
        </a>
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="income" ? "active" : "" );?>" href="<?php echo site_url('beautician/income');?>">รายได้</a>
        <!-- <a class="nav-link <?php echo ($this->uri->rsegment(2)=="feedback" ? "active" : "");?>"  href="#">feedback</a> -->
    </nav>
</div>
</div>

<?php endif?>



<?php 
if( ( $this->session->userdata('logged_in') === TRUE) && ($this->session->userdata('is_owner') === TRUE  ) ):
?>

<div class="nav-scroller bg-white box-shadow">
    <div class="container">
    <nav class="nav nav-underline">
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="payment" ? "active" : "" );?>" href="<?php echo site_url('owner/payment');?>">การจ่ายเงิน</a>
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="service" ? "active" : "" );?>" href="<?php echo site_url('owner/service');?>">บริการ</a>
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="beautician" ? "active" : "" );?>" href="<?php echo site_url('owner/beautician');?>">ช่างเสริมสวย</a>
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="income" ? "active" : "" );?>" href="<?php echo site_url('owner/income');?>">รายได้</a>
        
    </nav>
</div>
</div>

<?php endif?>