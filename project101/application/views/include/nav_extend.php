

<?php 
if( ( $this->session->userdata('logged_in') === TRUE) && ($this->session->userdata('is_beautician') === TRUE  ) ):
?>

<div class="nav-scroller bg-white box-shadow">
    <div class="container">
    <nav class="nav nav-underline">
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="jobs" ? "active" : "" );?>" href="<?php echo site_url('beautician/jobs');?>">
            jobs
                <?php 
                $v_rs = $this->beautician_model->tasks($this->session->userdata('user_id'),'waiting');
                if ($v_rs->num_rows() > 0 ){
                    echo '<span class="badge badge-pill badge-danger align-text-bottom">';
                    echo $v_rs->num_rows();
                    echo '</span>';
                }
                ?>
            
        </a>
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="income" ? "active" : "" );?>" href="<?php echo site_url('beautician/income');?>">income</a>
        <a class="nav-link <?php echo ($this->uri->rsegment(2)=="feedback" ? "active" : "");?>"  href="#">feedback</a>
    </nav>
</div>
</div>

<?php endif?>