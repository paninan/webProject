
<!doctype html>
<html lang="en">
    <head>
        <?php $this->load->view('include/head.php')?>
    </head>
  <body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <?php $this->load->view('include/nav.php');?>
        </nav>
    </header>

    <main role="main" class="container">
    <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">

            <?php
            foreach($m_service->result() as $ser ){
            //for ($i = 0; $i < 10 ; $i++) {
            ?>
                <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top"  alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?php echo $ser->service_img?>" data-holder-rendered="true">
                
                <!-- <h5 class="card-header">Featured</h5> -->
                
                <div class="card-body">
                  <h4> <?php echo $ser->service_name ?></h4>
                    <p class="card-text"> <?php echo $ser->service_description ?></p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="<?php echo site_url('service/reservations/'.$ser->service_id)?>" class="btn btn-sm btn-outline-success">จอง</a>
                        <a href="<?php echo site_url('review/service/'.$ser->service_id)?>" class="btn btn-sm btn-outline-secondary">รีวิว</a>
                      </div>
                    </div>
                    <br/>
                    <small class="text-muted">ราคา : <?php echo $ser->service_price?> ฿</small>
                  </div>
                  
              </div>

            </div>
            <?php
            }
            ?>

            
          </div>
        </div>
      </div>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
    <?php $this->load->view('include/footer.php');?>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php $this->load->view('include/js'); ?>
  </body>
</html>
