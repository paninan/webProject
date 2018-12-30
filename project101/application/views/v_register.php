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
            <label for="user_firstname">Name</label>
            <input type="text" class="form-control" id="user_firstname" name="user_firstname" placeholder="name" >
        </div>
        <div class="form-group">
            <label for="user_nickname">Nick Name</label>
            <input type="text" class="form-control" id="user_nickname" name="user_nickname" placeholder="name" >
        </div>
        

        <div class="form-group">
            <label for="user_gender">Gender</label><br />
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="user_gender_male"
                name="user_gender" value="M">
                <label class="form-check-label" for="user_gender_male">Men</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="user_gender_women"
                name="user_gender" value="F">
                <label class="form-check-label" for="user_gender_women">Women</label>
            </div>
        </div>

        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="email@email.com" >
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="" >
        </div>
        <div class="form-group">
            <label for="user_phone">Phone</label>
            <input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="088 8888 8888" >
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
      array_push($cus_emails,$row->user_email);
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