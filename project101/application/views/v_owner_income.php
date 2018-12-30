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
                    <span class="text-muted">Your Revenue</span>
                    <!-- <span class="badge badge-secondary badge-pill"> </span> -->
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Monthly (
                                <?php echo date('Y-m');?>)</h6>
                            <small class="text-muted">com. 55% / jobs</small>
                        </div>
                        <span class="text-muted">฿
                            <?php if($m_income_monthly->num_rows() > 0 ):?>
                            <?php echo number_format($m_income_monthly->row(0)->owner_commission); ?>
                            <?php endif?> /
                            <?php if($m_income_monthly->num_rows() > 0 ):?>
                            <?php echo $m_income_monthly->row(0)->cnt_job; ?>
                            <?php endif?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Daily (
                                <?php echo date('Y-m-d');?>)</h6>
                            <small class="text-muted">com. 55% / jobs</small>
                        </div>
                        <span class="text-muted">
                            <?php if($m_income_daily->num_rows() > 0 ):?>
                            ฿
                            <?php echo number_format($m_income_daily->row(0)->owner_commission); ?>
                            /
                            <?php echo $m_income_daily->row(0)->cnt_job; ?>
                            <?php else: ?>
                            - / -
                            <?php endif?>
                        </span>
                        </span>
                    </li>

                </ul>

                <ul class="list-group">
                    <?php  foreach($m_sum_monthly->result() as $row_sum):?>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <strong class="">
                                <?php echo $row_sum->user_firstname;?>
                            </strong>
                            <span class="">
                                <?php echo $row_sum->beautician_commission;?> /
                                <?php echo $row_sum->owner_commission;?>
                            </span>
                        </div>
                        <span class="d-block text-gray-dark">
                            <?php echo $row_sum->user_email;?>
                        </span>
                    </li>
                    <?php endforeach;?>
                </ul>

                <!-- <form class="card p-2">
        <div class="input-group">
            <select class="form-control" id="month" name="month">
             


            </select>
        </div>
    </form> -->
            </div>

            <div class="col">
                <canvas id="myChart"></canvas>
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
        var m_labels = [];
        var m_datas = [];

        <?php
        if($m_service_monthly->num_rows() > 0 ){
            $labels = array();
            $datas = array();
            foreach($m_service_monthly->result() as $row ){
                array_push($labels,$row->service_name);
                array_push($datas, floatval( $row->beautician_commission) );
            }
            echo "m_labels = ".json_encode($labels).";";
            echo "m_datas = ".json_encode($datas).";";
        }
        ?>

        $(function () {
            var ctx = $("#myChart");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: m_labels || [],
                    datasets: [{
                        label: '# of Votes',
                        data: m_datas || [],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

        });
    </script>


</body>

</html>