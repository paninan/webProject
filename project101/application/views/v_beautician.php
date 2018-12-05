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
        <div class="row">
            <!-- <div class="col-md-4"></div> -->
            <div class="col-md-10">
                <div class="my-3 p-3 bg-white rounded box-shadow">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
                    <?php foreach($m_beauti_task->result() as  $row ):?>

                    <div class="media text-muted pt-3">
                        <img class="mr-2 rounded" src="<?php echo $row->service_img?>" data-holder-rendered="true"
                            style="width: 72px; height: 72px;">
                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="row w-100">
                                    <div class="col-8">
                                        <strong class="text-gray-dark"><?php echo $row->service_name?></strong>
                                        <span class="d-block">
                                            <!-- <strong class="text-gray-dark"> Period </strong>  -->
                                            <span><?php echo $row->start_time?> to <?php echo $row->end_time?></span>
                                        </span>
                                    </div>
                                    <div class="col-4">
                                        <a href="<?php echo site_url('beautician/reject/'.$row->reser_id);?>" class="float-right btn btn-sm btn-link ">Cancel</a>
                                        <a href="<?php echo site_url('beautician/confirm/'.$row->reser_id);?>" class="float-right btn btn-sm btn-outline-success">Confirm</a>
                                    </div>
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
                    <small class="d-block text-right mt-3">
                        <a href="#">All updates</a>
                    </small>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
</body>

</html>