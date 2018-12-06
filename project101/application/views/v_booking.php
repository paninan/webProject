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
        
        <h3>Booking</h3>
        <form action="<?php echo current_url();?>" method="post" id="frm-booking">
            <div class="form-group">
                <label for="email">Email address</label>
                <?php
                if($this->session->userdata('logged_in') === TRUE){
                    echo '<input type="email" class="form-control" id="email" name="email" value="'.$this->session->userdata('user_email').'" >';
                }else{
                    echo '<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">';
                }
                ?>
                
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <?php
                if($this->session->userdata('logged_in') === TRUE){
                    echo '<input type="text" class="form-control" id="telephone" name="telephone" value="'.$this->session->userdata('user_phone').'">';
                }else{
                    echo '<input type="text" class="form-control" id="telephone" name="telephone">';
                }
                ?>
                
            </div>
            <div class="form-group">
                <label for="message"></label>
                <textarea class="form-control" id="message"  name="message" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

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



        });
    </script>

</body>

</html>