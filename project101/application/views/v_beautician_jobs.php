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
                    <a href="<?php echo site_url('beautician/jobs/waiting');?>" class="list-group-item list-group-item-action <?php echo ($m_status == "
                        waiting" ? "active" :""); ?>">Waiting</a>
                    <a href="<?php echo site_url('beautician/jobs/confirm');?>" class="list-group-item list-group-item-action <?php echo ($m_status == "
                        confirm" ? "active" :""); ?>">Confirm</a>
                    <a href="<?php echo site_url('beautician/jobs/reject');?>" class="list-group-item list-group-item-action <?php echo ($m_status == "
                        reject" ? "active" :""); ?>">Reject</a>
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
                                    <?php if($m_status == "waiting"):?>
                                    <div class="col-4">
                                        <a href="<?php echo site_url('beautician/reject/'.$row->reser_id);?>" class="float-right btn btn-sm btn-link ">Cancel</a>
                                        <a href="<?php echo site_url('beautician/confirm/'.$row->reser_id);?>" class="float-right btn btn-sm btn-outline-success">Confirm</a>
                                    </div>
                                    <?php endif?>

                                    <?php if($m_status == "confirm"):?>
                                    <?php if($row->pay == 0):?>
                                    <a href="<?php echo site_url('beautician/pay/'.$row->reser_id);?>" class="float-right btn btn-sm btn-success "  data-popup="modal" data-modal-id="#cf-customer-paid" >Pay</a>
                                    <?php endif?>

                                    <?php if($row->pay == 1):?>
                                    <span class="float-right disabled btn btn-sm btn-success ">Paid</span>
                                    <?php endif?>

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
                    Confirm your customer <br/>paid complete 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-btn="close">Close</button>
                    <button type="button" class="btn btn-primary" data-btn="ok" >Ok</button>
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

            $("[data-popup='modal']").on('click',function(event){
                
                var modalID = $(this).data('modal-id');
                var url = $(this).prop('href');
                $(modalID).modal('show');

                $('[data-btn="ok"]',$(modalID)).on('click',function(){
                    $(modalID).modal('hide');
                    setTimeout(function () {
                        window.location.href = url;
                    }, 300);
                });

                event.preventDefault();
            });

            // $('#exampleModal').on('show.bs.modal', function (event) {
            //     var button = $(event.relatedTarget) // Button that triggered the modal
            //     var recipient = button.data('whatever') // Extract info from data-* attributes
            //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            //     var modal = $(this)
            //     modal.find('.modal-title').text('New message to ' + recipient)
            //     modal.find('.modal-body input').val(recipient)
            // })
        });

    </script>

    
</body>

</html>