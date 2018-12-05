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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo nav_active('home',$controller_sgm); ?>">
              <a class="nav-link" href="<?php echo site_url('home');?>">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item <?php echo nav_active('service',$controller_sgm); ?>">
                <a class="nav-link" href="<?php echo site_url('service');?>">Service</a>
            </li>
            
            <li class="nav-item <?php echo nav_active('review',$controller_sgm); ?>">
                <a class="nav-link" href="<?php echo site_url('review');?>">Review</a>
            </li>

            <li class="nav-item <?php echo nav_active('beautician',$controller_sgm); ?>">
                <a class="nav-link" href="<?php echo site_url('beautician');?>">Beautician</a>
            </li>

          </ul>
          <a class="btn btn-outline-primary" href="<?php echo site_url('auth/login');?>">Sign up</a>
          
        </div>
      