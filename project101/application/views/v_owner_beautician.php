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
            <?php 
            // edit betician >> m_beautician_edit
            $v_beau_id = NULL;
            $v_beau_name = NULL;
            $v_beau_lastname = NULL;
            $v_beau_address = NULL;
            $v_beau_gender = NULL;
            $v_beau_email = NULL;
            $v_beau_password = NULL;
            $v_beau_phone = NULL;
            $v_beau_position = NULL;

            $url_action = site_url('owner/add_beautician');
            
            if ( isset( $m_beautician_edit ) && ($m_beautician_edit->num_rows()>0) ){
                $v_beau_id = $m_beautician_edit->row(0)->beau_id;
                $v_beau_name = $m_beautician_edit->row(0)->beau_name;
                $v_beau_lastname = $m_beautician_edit->row(0)->beau_lastname;
                $v_beau_address = $m_beautician_edit->row(0)->beau_address;
                $v_beau_gender = $m_beautician_edit->row(0)->beau_gender;
                $v_beau_email = $m_beautician_edit->row(0)->beau_email;
                $v_beau_password = $m_beautician_edit->row(0)->beau_password;
                $v_beau_phone = $m_beautician_edit->row(0)->beau_phone;
                $v_beau_position = $m_beautician_edit->row(0)->beau_position;

                $url_action = site_url('owner/edit_beautician');
            }
                        
         ?>

            <div class="col-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">
                        <?php echo (empty($v_beau_id) ? "Add" :"Edit")?> Beatician</span>
                </h4>
                <form action="<?php echo $url_action?>" method="POST">

                    <?php 

                    if( !empty($v_beau_id) ){
                        echo '<input type="hidden" name="beau_id" value="'.$v_beau_id.'" />';
                    }
                    ?>

                    <div class="form-group">
                        <label for="beau_name">Name</label>
                        <input type="text" class="form-control" id="beau_name" name="beau_name" placeholder="name"
                            value="<?php echo $v_beau_name;?>">
                    </div>
                    <div class="form-group">
                        <label for="beau_lastname">Last Name</label>
                        <input type="text" class="form-control" id="beau_lastname" name="beau_lastname" placeholder="name"
                            value="<?php echo $v_beau_lastname;?>">
                    </div>
                    <div class="form-group">
                        <label for="beau_address">Address</label>
                        <textarea class="form-control" id="beau_address" name="beau_address" rows="3"><?php echo $v_beau_address;?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="beau_gender">Gender</label><br />
                        <div class="form-check form-check-inline">
                            <?php 
                            $checked_m = $v_beau_gender == "M"  ? "checked" : "";
                            $checked_w = $v_beau_gender == "W"  ? "checked" : "";
                            ?>
                            <input class="form-check-input" <?php echo $checked_m?> type="radio" id="beau_gender_male"
                            name="beau_gender" value="M">
                            <label class="form-check-label" for="beau_gender_male">Men</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php echo $checked_w?> type="radio" id="beau_gender_women"
                            name="beau_gender" value="W">
                            <label class="form-check-label" for="beau_gender_women">Women</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="beau_email">Email</label>
                        <input type="email" class="form-control" id="beau_email" name="beau_email" placeholder="email@email.com"
                            value="<?php echo $v_beau_email;?>">
                    </div>
                    <div class="form-group">
                        <label for="beau_password">Password</label>
                        <input type="text" class="form-control" id="beau_password" name="beau_password" placeholder=""
                            value="<?php echo $v_beau_password;?>">
                    </div>
                    <div class="form-group">
                        <label for="beau_phone">Phone</label>
                        <input type="text" class="form-control" id="beau_phone" name="beau_phone" placeholder="088 8888 8888"
                            value="<?php echo $v_beau_phone;?>">
                    </div>
                    <button class="btn btn-primary" type="submit" <?php echo (empty($v_beau_id) ?
                        "data-action='edit-beau'" :"")?> >Submit</button>
                </form>

            </div>

            <div class="col">

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">Name</th>
                                <!-- <th scope="col" >Lastname</th> -->
                                <th scope="col">Address</th>
                                <th scope="col">Gender</th>
                                <!-- <th scope="col" >email</th> -->
                                <th scope="col">password</th>
                                <th scope="col">phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($m_beautician->result() as $beauticain ): ?>
                            <tr>
                                <td>
                                    <a class="d-inline-block" href="<?php echo site_url('owner/beautician/'.$beauticain->beau_id);?>"
                                        data-action="edit">
                                        <span class="oi oi-pencil"></span>
                                    </a>
                                    <a class="d-inline-block text-danger" href="<?php echo site_url('owner/delete_beautician/'.$beauticain->beau_id);?>" 
                                        data-action="delete" data-modal-id="#cf-beau-msg">
                                        <span class="oi oi-x"></span>
                                    </a>
                                </td>
                                <td>
                                    <span class="d-block">
                                        <?php echo $beauticain->beau_name;?>&nbsp;
                                        <?php echo $beauticain->beau_lastname;?></span>
                                    <span class="d-block">
                                        <?php echo $beauticain->beau_email;?></span>
                                </td>
                                <!-- <td><?php echo $beauticain->beau_lastname;?></td> -->
                                <td>
                                    <?php echo $beauticain->beau_address;?>
                                </td>
                                <td>
                                    <?php echo $beauticain->beau_gender;?>
                                </td>
                                <!-- <td><?php echo $beauticain->beau_email;?></td> -->
                                <td>
                                    <?php echo $beauticain->beau_password;?>
                                </td>
                                <td>
                                    <?php echo $beauticain->beau_phone;?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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
    <div class="modal fade" id="cf-beau-msg" tabindex="-1" role="dialog" aria-labelledby="cf-beau-msg-label"
        aria-hidden="true">
        <div class="modal-dialog  modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cf-beau-msg-label"> Confirm alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You want to delete beatician ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-btn="close">Close</button>
                    <button type="button" class="btn btn-danger" data-btn="ok">Ok</button>
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

            $("[data-action='delete']").on('click', function (event) {

                var modalID = $(this).data('modal-id');
                var url = $(this).prop('href');
                $(modalID).modal('show');

                $('[data-btn="ok"]', $(modalID)).on('click', function () {
                    $(modalID).modal('hide');
                    setTimeout(function () {
                        window.location.href = url;
                    }, 300);
                });
                event.preventDefault();
            });


        });
    </script>


</body>

</html>