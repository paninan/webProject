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
                    <span class="text-muted">Your service</span>
                </h4>
                <form action="<?php echo site_url('owner/add_beautician')?>" method="POST">
                    <div class="form-group">
                        <label for="beau_name">Name</label>
                        <input type="text" class="form-control" id="beau_name" name="beau_name" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="beau_lastname">Last Name</label>
                        <input type="text" class="form-control" id="beau_lastname" name="beau_lastname" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="beau_address">Address</label>
                        <textarea class="form-control" id="beau_address" name="beau_address" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="beau_gender">Gender</label><br/>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="beau_gender_male"  name="beau_gender" value="M">
                            <label class="form-check-label" for="beau_gender_male">Men</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="beau_gender_women" name="beau_gender" value="W">
                            <label class="form-check-label" for="beau_gender_women">Women</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="beau_email">Email</label>
                        <input type="email" class="form-control" id="beau_email" name="beau_email" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="beau_password">Password</label>
                        <input type="text" class="form-control" id="beau_password" name="beau_password" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="beau_phone">Phone</label>
                        <input type="text" class="form-control" id="beau_phone" name="beau_phone" placeholder="name">
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>

            </div>

            <div class="col">
                
                <div class="table-responsive">
            <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col" >name</th>
                        <th scope="col" >lastname</th>
                        <th scope="col" >address</th>
                        <th scope="col" >gender</th>
                        <th scope="col" >email</th>
                        <th scope="col" >password</th>
                        <th scope="col" >phone</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($m_beautician->result() as $beauticain ): ?>
                      <tr>
                        <td><?php echo $beauticain->beau_name;?></td>
                        <td><?php echo $beauticain->beau_lastname;?></td>
                        <td><?php echo $beauticain->beau_address;?></td>
                        <td><?php echo $beauticain->beau_gender;?></td>
                        <td><?php echo $beauticain->beau_email;?></td>
                        <td><?php echo $beauticain->beau_password;?></td>
                        <td><?php echo $beauticain->beau_phone;?></td>
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