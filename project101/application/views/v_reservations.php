<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view('include/head.php')?>

    <!-- table style -->
    <style>
        table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>


</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <?php $this->load->view('include/nav.php');?>
        </nav>
    </header>

    <main role="main" class="container">
        
        <?php ?>
        <form action="<?php echo current_url();?>" method="post" id="frm-search-resv">
            <input type="hidden" name="has_date" value="<?php echo $has_date?>" />
            <input type="hidden" name="has_service" value="<?php echo $has_service?>" />
            <div class="row">

                <!-- select date -->
                <div class="col-sm">
                    <label for="rerv_datetime">Date select</label>
                    <select class="form-control" id="rerv_datetime" name="rerv_datetime">
                        <?php 
            // https://stackoverflow.com/questions/3207749/i-have-2-dates-in-php-how-can-i-run-a-foreach-loop-to-go-through-all-of-those-d
            $begin = new DateTime();
            $end = new DateTime(date('Y-m-d',strtotime(' +7 day')));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);
            foreach ($period as $dt) {
                $date_selected = ($has_date == $dt->format("Y-m-d") ) ? "selected=\"selected\"" : "";
                echo "<option {$date_selected} value='".$dt->format("Y-m-d")."'>".$dt->format("l Y-m-d")."</option>";
            }
            ?>
                    </select>
                </div>

                <!-- select service -->
                <div class="col-sm">
                    <label for="service_name">Service select</label>
                    <select class="form-control" id="service_name" name="service_name">
                        <?php 
                $service_active = NULL;
                foreach($services->result() as $row )
                {
                    $serv_selected = ($has_service == $row->service_id) ? "selected=\"selected\"" : "";
                    echo "<option {$serv_selected} value=\"".$row->service_id."\">".$row->service_name."</option>";

                    if($has_service == $row->service_id){
                        $service_active = $row;
                    }
                    
                }
                ?>
                    </select>
                </div>

                <!-- select time -->
                <div class="col-sm">
                    <?php
        // time addding in task
        $sec_in = $service_active->service_time * 60; 
        ?>
                    <label for="">&nbsp;</label>
                    <div class="col-sm">
                        <button class="btn btn-success" type="submit"> search</button>
                    </div>

                </div>
            </div>
        </form>
        <br />
        <br />

        <!-- table time -->
        <div class="table-responsive">
        <table class="table table-sm">
            <tr>
                <th width="200px">Time</th>
                <?php 
                foreach($beauticians->result() as $row ){
                    echo "<th>".$row->user_firstname."</th>";
                }
                ?>
            </tr>

            <?php
             $open_time = strtotime("{$has_date} 08:00");
             $close_time = strtotime("{$has_date} 20:30");
             $now = time();
             $output = "";
             for( $starttime=$open_time; $starttime<=$close_time; $starttime+=900) {
                 if ($starttime < $now) continue;
            ?>
            <tr>
                <td>
                    <?php echo date("l - H:i",$starttime);?>
                </td>
                <?php 
                foreach($beauticians->result() as $row ){

                    $rs = $this->beautician_model->check_available(
                        $row->user_id,
                        $has_service, // service id
                        date("Y-m-d H:i:s",$starttime)
                    );
                    $is_avb = $rs->num_rows() == 0;
                    $is_disable = $close_time > (($service_active->service_time*60) + $starttime )-901;
                    $is_avb = $is_avb && $is_disable;
                    
                    $css_colr = $is_avb ? "style=\"background-color:#9ee0bf\"":"class=\"bg-danger\"";
                    echo "<td ".$css_colr.">".( $is_avb  ?  "<a href=\"".site_url("service/book/{$has_service}/{$row->user_id}/${starttime}")."\" class=\"btn btn-success btn-sm btn-block\">Book</a>" : "Not Available" )."</td>";
                }
                ?>
            </tr>
            <?php
            }
            ?>
        </table>
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


    <script type="text/javascript">
        $(function () {


            $("#frm-search-resv").on('submit', function (e) {

                var frm = $(this);
                var h_date = $("[name=rerv_datetime]", frm).val();
                var h_service = $("[name=service_name]", frm).val();

                url = '<?php  echo site_url()?>service/reservations/' + h_service + '/' + h_date
                setTimeout(function () {
                    window.location.href = url;
                }, 300);

                e.preventDefault();
            });

        })

        // $('.carousel').carousel()
        // $("#carouselExampleIndicators").carousel()
    </script>

</body>

</html>