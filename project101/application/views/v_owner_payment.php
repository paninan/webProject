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
            <div class="col-md-2">
                <div class="list-group">
                    <a href="<?php echo site_url('owner/payment/waiting');?>" class="list-group-item list-group-item-action <?php echo ($m_status == "waiting" ? "active" :""); ?>">
                    Waiting
                    <?php
                    if ( $m_status == "waiting" && $m_beauti_task->num_rows() > 0 ){
                        echo '<span class="badge badge-pill badge-danger align-text-bottom">';
                        echo $m_beauti_task->num_rows();
                        echo '</span>';
                    }
                    ?>
                    </a>
                    <a href="<?php echo site_url('owner/payment/paid');?>" class="list-group-item list-group-item-action <?php echo ($m_status == "paid" ? "active" :""); ?>">Paid</a>
                </div>

            </div>
            <div class="col-md-10">
                <h5>
                    <?php echo strtoupper($m_status)?>
                </h5>
                <div class="my-3 p-3 bg-white rounded box-shadow">
                    <!-- <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6> -->
                    <?php foreach($m_beauti_task->result() as  $row ):?>

                    <div class="media text-muted pt-3">
                        <img class="mr-2 rounded" src="<?php echo $row->service_img?>" data-holder-rendered="true"
                            style="width: 72px; height: 72px;">
                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="row w-100">
                                    <div class="col-8">
                                        <strong class="text-gray-dark">
                                            <?php echo $row->service_name?> /
                                            <?php echo $row->service_price?> ฿</strong>
                                        <span class="d-block">
                                            <!-- <strong class="text-gray-dark"> Period </strong>  -->
                                            <span>
                                                <?php echo $row->start_time?> to
                                                <?php echo $row->end_time?></span>
                                        </span>
                                    </div>
                                    
                                    <?php if($row->pay == 0):?>
                                    <!-- Modal popup--> 
                                    <div class="modal fade" id="cf-customer-paid-<?php echo $row->reser_id?>" tabindex="-1"
                                        role="dialog" aria-labelledby="cf-customer-paidLabel-<?php echo $row->reser_id?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cf-customer-paidLabel-<?php echo $row->reser_id?>">Payment confirm</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="frm-customer-paid-<?php echo $row->reser_id?>" action="<?php echo site_url('owner/paid');?>" method="POST">
                                                    <input type="hidden" name="payment_cus_point" value="<?php echo $row->user_point?>" />
                                                    <input type="hidden" name="payment_service_id" value="<?php echo $row->service_id?>" />
                                                    <input type="hidden" name="payment_reser_id" value="<?php echo $row->reser_id?>" />
                                                    <input type="hidden" name="payment_customer_id" value="<?php echo $row->customer_id?>" />
                                                    <input type="hidden" name="payment_beautician_id" value="<?php echo $row->beau_id?>" />
                                                        <div class="alert alert-success" role="alert">
                                                            <div class="d-flex justify-content-between align-items-center w-100">
                                                                <h6>Point : <strong><?php echo $row->user_point?></strong></h6>
                                                                <small>1 point = 1 baht</small>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="payment_service_name" class="col-sm-4 col-form-label">Service
                                                                Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" readonly class="form-control-plaintext"
                                                                    name="payment_service_name" value="<?php echo $row->service_name?>"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="payment_service_price" class="col-sm-4 col-form-label">Price</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" readonly class="form-control-plaintext"
                                                                    name="payment_service_price" value="<?php echo $row->service_price?>" >
                                                            </div>
                                                        </div>
                                                        <hr class="mb-4">
                                                        <?php if($row->user_point>0):?>
                                                        <div class="form-group row">
                                                                <label for="use_point" class="col-sm-4 col-form-label">Use point
                                                                    Price</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control text-xl"
                                                                        min="0"  max="<?php echo $row->user_point?>"
                                                                        name="use_point" value="0" >
                                                                </div>
                                                        </div>
                                                        <?php endif;?>
                                                        <div class="form-group row">
                                                            <label for="payment_price" class="col-sm-4 col-form-label">Total
                                                                Price</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control text-xl" readonly
                                                                    name="payment_price" value="<?php echo $row->service_price?>" >
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        data-btn="close">Close</button>
                                                    <button type="button" class="btn btn-primary" data-btn="ok" 
                                                    data-form="#frm-customer-paid-<?php echo $row->reser_id?>"
                                                    data-modal-target="#cf-customer-paid-<?php echo $row->reser_id?>" >Ok</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END POPUP on bootstrap call modal -->
                                    
                                    <a href="<?php echo site_url('beautician/pay/'.$row->reser_id);?>" class="float-right btn btn-sm btn-success "
                                        data-popup="modal" data-modal-id="#cf-customer-paid-<?php echo $row->reser_id?>">Pay</a> 
                                    <?php endif?>

                                    


                                    <?php if($row->pay == 1):?>
                                        <span class="float-right disabled btn btn-sm btn-success ">Paid</span>
                                    <?php endif?>
                                </div>

                            </div>
                            <span class="d-block">
                                <?php echo $row->customer_name?></span>
                            <span class="d-block">Message :
                                <?php echo $row->message?></span>
                            <span class="d-block">Tel. :
                                <?php echo $row->telephone?></span>


                        </div>
                    </div>

                    <?php endforeach;?>
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
        $(function () {

            $("[data-popup='modal']").on('click', function (event) {

                var modalID = $(this).data('modal-id');
                var url = $(this).prop('href');
                $(modalID).modal('show');

                event.preventDefault();
            });

            $("[data-btn='ok']").on('click',function(event){
                
                var _frm = $(this).data('form'); 
                var _modal =$(this).data('modal-target');

                $(_modal).modal('hide');
                setTimeout(function () {
                    $(_frm).submit();
                }, 300);

                event.preventDefault();
            });

           $("[name=use_point]").on('change',function(){
               var frm = $(this).closest('form');
               var mxPoint =$("[name=payment_cus_point]",frm).val();
               var point = $(this).val();
               var price = $("[name=payment_service_price]",frm).val();
            
               $("[name=payment_price]",frm).val( Math.abs(parseInt(price) - parseInt(point) ));
               $("h6 strong",frm).text(Math.abs(parseInt(mxPoint)-parseInt(point)));
           });
        });
    </script>


</body>

</html>