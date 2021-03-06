<?php
$controller_sgm = $this->uri->segment(1);

function nav_active($first_segment=NULL,$controller_sgm){

  if($controller_sgm == $first_segment){
    return "active";
  }
  return "";
}

?>

<a class="navbar-brand" href="#">Beautiful Wow</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
  aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item <?php echo nav_active('home',$controller_sgm); ?>">
      <a class="nav-link" href="<?php echo site_url('home');?>">หน้าหลัก <span class="sr-only">(current)</span></a>
    </li>

    <li class="nav-item <?php echo nav_active('service',$controller_sgm); ?>">
      <a class="nav-link" href="<?php echo site_url('service');?>">บริการ</a>
    </li>

    <li class="nav-item <?php echo nav_active('review',$controller_sgm); ?>">
      <a class="nav-link" href="<?php echo site_url('review');?>">รีวิว</a>
    </li>
    <?php 
    if($this->session->userdata('logged_in') === TRUE && 
    ( $this->session->userdata('is_beautician') === TRUE ) )
    {
    ?>
    <li class="nav-item <?php echo nav_active('beautician',$controller_sgm); ?>">
      <a class="nav-link" href="<?php echo site_url('beautician');?>">ช่างเสริมสวย</a>
    </li>
    <?php 
    }  
    ?>

    <?php 
    if($this->session->userdata('logged_in') === TRUE && 
    ( $this->session->userdata('is_owner') === TRUE  ) )
    {
    ?>
    <li class="nav-item <?php echo nav_active('owner',$controller_sgm); ?>">
      <a class="nav-link" href="<?php echo site_url('owner');?>">เจ้าของร้าน</a>
    </li>
    <?php 
    }  
    ?>

  </ul>

  <?php 
  if( $this->session->userdata('logged_in') === TRUE){
      echo '<a class="btn btn-link text-light" href="javascript:void();"><span class="oi oi-sun"></span> &nbsp;'.$this->session->userdata('user_email').'</a>';
      echo '<a class="btn btn-outline-primary" href="'.site_url('auth/logout').'">Logout</a>';
    }else{
      echo '<a class="btn btn-outline-primary" href="'.site_url('auth/login').'">Login</a>';
    }
  ?>

</div>