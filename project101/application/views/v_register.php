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
    <form class="needs-validation" novalidate="" name="frm-register" id="frm-register" action="<?php echo site_url('register/add');?>" method="POST">
        <div class="form-group">
            <label for="customer_name">Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="name" >
        </div>
        <div class="form-group">
            <label for="customer_nickname">Nick Name</label>
            <input type="text" class="form-control" id="customer_nickname" name="customer_nickname" placeholder="name" >
        </div>
        

        <div class="form-group">
            <label for="customer_gender">Gender</label><br />
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="customer_gender_male"
                name="customer_gender" value="M">
                <label class="form-check-label" for="customer_gender_male">Men</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="customer_gender_women"
                name="customer_gender" value="W">
                <label class="form-check-label" for="customer_gender_women">Women</label>
            </div>
        </div>

        <div class="form-group">
            <label for="customer_email">Email</label>
            <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="email@email.com" >
        </div>
        <div class="form-group">
            <label for="customer_password">Password</label>
            <input type="password" class="form-control" id="customer_password" name="customer_password" placeholder="" >
        </div>
        <div class="form-group">
            <label for="customer_phone">Phone</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="088 8888 8888" >
        </div>
      
      <hr class="mb-4">
      <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to Register</button>
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
  var email_exists = [];
  <?php 
  
  if($m_customer->num_rows() > 0 ){
    $cus_emails = array();
    foreach($m_customer->result() as $row){
      array_push($cus_emails,$row->customer_email);
    }
    echo "email_exists = ".json_encode($cus_emails);
  }
  ?>

  $(function(){
    
    $("#frm-register").on('submit',function(event){

      var $ths = $(this);
      var email = $('[name=customer_email]',$ths).val();

      if($.inArray(email, email_exists) !== -1){
        alert(email+' is exists')
        event.preventDefault() 
      }

    })
    
  })
  </script>
</body>

</html>