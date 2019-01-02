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

        <div class="container">

            <div class="row">

                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="<?php echo $m_review->row(0)->service_img?>" data-holder-rendered="true">

                        <!-- <h5 class="card-header">Featured</h5> -->

                        <div class="card-body">
                            <h4>
                                <?php echo $m_review->row(0)->service_name ?>
                            </h4>
                            <p class="card-text">
                                <?php echo $m_review->row(0)->service_description ?>
                            </p>

                            <p class="">ราคา :
                                <?php echo $m_review->row(0)->service_price?> ฿</[small]>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('service/reservations/'.$m_review->row(0)->service_id)?>"
                                            class="btn btn-sm btn-outline-success">จอง</a>
                                    </div>
                                </div>
                        </div>

                    </div>

                    <form class="needs-validation" novalidate="" action="<?php echo current_url();?>" method="POST">
                        <legend>แสดงความคิดเห็น</legend>
                        <div class="row">
                            <div class="col-md-12 mb-12">
                                <label for="firstName">ชื่อ</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="" value=""
                                    required="">
                            </div>
                            <div class="col-md-12 mb-12">
                                <label for="lastName">ข้อความ</label>
                                <textarea class="form-control" name="message"></textarea>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">ส่งความคิดเห็น</button>
                    </form>

                </div>


                <div class="col">
                    <h4>ความคิกเห็น</h4>
                    <?php foreach( $m_review->result() as $row ):?>

                    <?php 
                    
                    if(empty($row->review_message )){
                        continue;
                    }
                    ?>
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">
                                    <?php echo $row->review_message?></strong>
                                <span>
                                    <?php echo date('Y ,M j',strtotime($row->review_date))?></span>
                            </div>
                            <span class="d-block">
                                <?php echo $row->review_name?></span>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>

            </div> <!-- end class row -->


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