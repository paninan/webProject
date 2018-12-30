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
            $v_user_id = NULL;
            $v_user_firstname = NULL;
            $v_user_lastname = NULL;
            $v_user_address = NULL;
            $v_user_gender = NULL;
            $v_user_email = NULL;
            $v_user_password = NULL;
            $v_user_phone = NULL;
            $v_user_type = NULL;
            $v_user_picture= NULL;

            $url_action = site_url('owner/add_beautician');
            
            if ( isset( $m_beautician_edit ) && ($m_beautician_edit->num_rows()>0) ){
                $v_user_id = $m_beautician_edit->row(0)->user_id;
                $v_user_firstname = $m_beautician_edit->row(0)->user_firstname;
                $v_user_lastname = $m_beautician_edit->row(0)->user_lastname;
                $v_user_address = $m_beautician_edit->row(0)->user_address;
                $v_user_gender = $m_beautician_edit->row(0)->user_gender;
                $v_user_email = $m_beautician_edit->row(0)->user_email;
                $v_user_password = $m_beautician_edit->row(0)->user_password;
                $v_user_phone = $m_beautician_edit->row(0)->user_phone;
                $v_user_type = $m_beautician_edit->row(0)->user_type;
                $v_user_picture= site_url($m_beautician_edit->row(0)->user_picture);

                $url_action = site_url('owner/edit_beautician');
            }
                        
         ?>

            <div class="col-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">
                        <?php echo (empty($v_user_id) ? "Add" :"Edit")?> Beatician</span>
                </h4>
                <!-- <form action="<?php echo $url_action?>" method="POST"> -->
                <?php echo form_open_multipart($url_action);?>

                    <?php 

                    if( !empty($v_user_id) ){
                        echo '<input type="hidden" name="user_id" value="'.$v_user_id.'" />';
                    }
                    ?>
                    <div class="form-group">
                        <div class="custom-file">
                            <img id="picture-example" src="<?php echo $v_user_picture;?>" class="img-thumbnail">
                            <input type="file" class="custom-file-input" name="picture" id="picture" accept="image/*">
                            <label class="custom-file-label" for="picture">Choose Beauticain Picture</label>
                            <small class="mark">image file [jpeg,png] <br/>Size < 10 Mb ,1024x1024px</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_firstname">Name</label>
                        <input type="text" class="form-control" id="user_firstname" name="user_firstname" placeholder="name"
                            value="<?php echo $v_user_firstname;?>">
                    </div>
                    <div class="form-group">
                        <label for="user_lastname">Last Name</label>
                        <input type="text" class="form-control" id="user_lastname" name="user_lastname" placeholder="name"
                            value="<?php echo $v_user_lastname;?>">
                    </div>
                    <div class="form-group">
                        <label for="user_address">Address</label>
                        <textarea class="form-control" id="user_address" name="user_address" rows="3"><?php echo $v_user_address;?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="user_gender">Gender</label><br />
                        <div class="form-check form-check-inline">
                            <?php 
                            $checked_m = $v_user_gender == "M"  ? "checked" : "";
                            $checked_w = $v_user_gender == "F"  ? "checked" : "";
                            ?>
                            <input class="form-check-input" <?php echo $checked_m?> type="radio" id="user_gender_male"
                            name="user_gender" value="M">
                            <label class="form-check-label" for="user_gender_male">Men</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" <?php echo $checked_w?> type="radio" id="user_gender_women"
                            name="user_gender" value="F">
                            <label class="form-check-label" for="user_gender_women">Women</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="email@email.com"
                            value="<?php echo $v_user_email;?>">
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="text" class="form-control" id="user_password" name="user_password" placeholder=""
                            value="<?php echo $v_user_password;?>">
                    </div>
                    <div class="form-group">
                        <label for="user_phone">Phone</label>
                        <input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="088 8888 8888"
                            value="<?php echo $v_user_phone;?>">
                    </div>
                    <button class="btn btn-primary" type="submit" <?php echo (empty($v_user_id) ?
                        "data-action='edit-beau'" :"")?> >Submit</button>
                </form>

            </div>

            <div class="col">

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th width="10%"></th>
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
                                    <a class="d-inline-block" href="<?php echo site_url('owner/beautician/'.$beauticain->user_id);?>"
                                        data-action="edit">
                                        <span class="oi oi-pencil"></span>
                                    </a>
                                    <a class="d-inline-block text-danger" href="<?php echo site_url('owner/delete_beautician/'.$beauticain->user_id);?>" 
                                        data-action="delete" data-modal-id="#cf-beau-msg">
                                        <span class="oi oi-x"></span>
                                    </a>
                                </td>
                                <td>
                                <?php if($beauticain->user_picture != ""):?>
                                    <img src="<?php echo site_url($beauticain->user_picture);?>" class="img-thumbnail rounded">
                                <?php endif;?>
                                </td>
                                <td>
                                    <span class="d-block">
                                        <?php echo $beauticain->user_firstname;?>&nbsp;
                                        <?php echo $beauticain->user_lastname;?></span>
                                    <span class="d-block">
                                        <?php echo $beauticain->user_email;?></span>
                                </td>
                                <!-- <td><?php echo $beauticain->user_lastname;?></td> -->
                                <td>
                                    <?php echo $beauticain->user_address;?>
                                </td>
                                <td>
                                    <?php echo $beauticain->user_gender;?>
                                </td>
                                <!-- <td><?php echo $beauticain->user_email;?></td> -->
                                <td>
                                    <?php echo $beauticain->user_password;?>
                                </td>
                                <td>
                                    <?php echo $beauticain->user_phone;?>
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

        function readerImg(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#picture-example').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        var $picture = $("input[name=picture]");
        $picture.on('change',function(){
            var input = $(this).get(0);
            if (input.files && input.files[0]) {
                readerImg(input)
            }
            
        });
        
        
    </script>


</body>

</html>