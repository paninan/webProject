<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('include/head.php')?>

    <!-- Custom styles for this template -->
    <link href="<?php echo site_url()?>assets/css/offcanvas.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <?php $this->load->view('include/nav.php');?>
        </nav>
        <?php $this->load->view('include/nav_extend')?>
    </header>
    <main role="main" class="container">
        <div class="row">

            <div class="col-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">บริการ</span>
                </h4>

                <form action="<?php echo site_url('owner/add_service')?>" method="POST">
                    <div class="form-group">
                        <label for="service_name">ชื่อ</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Service name">
                    </div>
                    <div class="form-group">
                        <label for="service_type">ประเภท</label>
                        <select class="form-control" name="service_type" id="service_type" >
                            <?php foreach($m_service_type->result() as $row):?>
                            <option value="<?php echo $row->service_type_id?>" ><?php echo ucfirst($row->service_type_name)?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service_time">ระยะเวลา</label>
                        <select class="form-control" name="service_time" id="service_time" >
                            <?php
                            for( $i=900; $i <=  (4 * 60 * 60 ) ; $i+=900) {
                                echo "<option value=\"".($i/60)."\">".gmdate("H:i",$i)."</option>";
                            }
                            ?>
                        </select>
                        <small id="passwordHelpInline" class="text-muted">
                        น้อยสุด:15 นาที , สูงสุด : 4 ชม.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="service_price">ราคา</label>
                        <input type="number" min="100" class="form-control" id="service_price" name="service_price" >
                    </div>

                    <div class="form-group">
                        <label for="service_img">link รูปตัวอย่าง</label>
                        <input type="text"  class="form-control" id="service_img" name="service_img" >
                    </div>
                    
                    <div class="form-group">
                        <label for="service_description">รายละเอียด</label>
                        <textarea class="form-control" id="service_description" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">บันทึก</button>
                </form>

            </div>

            <div class="col">
                <div class=row>
                    <?php
            foreach($m_service_all->result() as $ser ){
            
            ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                                src="<?php echo $ser->service_img?>" data-holder-rendered="true">
                            <div class="card-body">
                                <h4>
                                    <?php echo $ser->service_name ?>
                                </h4>
                                <p class="card-text">
                                    <?php echo $ser->service_description ?>
                                </p>
                                <p class="card-text">
                                    <?php echo $ser->service_time ?> นาที</p>
                                <small class="text-muted">ราคา :
                                    <?php echo $ser->service_price?> ฿</small>
                                <br />
                                
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <?php 
                                    $class_active = ( $ser->service_active == 1 ? "btn-dark" : "btn-outline-dark " );
                                    $class_deactive = ( $ser->service_active == 0 ? "btn-dark" : "btn-outline-dark " );
                                    ?>
                                    
                                    <a class="btn <?php echo $class_deactive?> btn-sm" href="<?php echo site_url('owner/service_deactive/'.$ser->service_id);?>"
                                        class="btn btn-danger">ไม่ใช้งาน</a>
                                    <a class="btn <?php echo $class_active?>  btn-sm" href="<?php echo site_url('owner/service_active/'.$ser->service_id);?>"
                                        class="btn btn-danger">ใช้งาน</a>
                                </div>

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

    <!-- POPUP on bootstrap call modal -->

    <!-- Modal -->
    <div class="modal fade" id="cf-customer-paid" tabindex="-1" role="dialog" aria-labelledby="cf-customer-paidLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cf-customer-paidLabel">Payment confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirm your customer <br />paid complete
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-btn="close">Close</button>
                    <button type="button" class="btn btn-primary" data-btn="ok">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END POPUP on bootstrap call modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php $this->load->view('include/js')?>

    <script type="text/javascript">
       
    </script>


</body>

</html>