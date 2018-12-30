<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('include/head.php'); ?>
  <link href="<?php echo site_url()?>assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin" name="frmlogin" action="<?php echo site_url()?>auth/chk_login" method="POST">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    <!-- My teacher want to remove user type from login page
    <select class="form-control" name="login_type" id="login_type">
      <option value="member">Member</option>
      <option value="owner">Owner</option>
      <option value="beautician">Beautician</option>
    </select>
    -->
    <hr class="mb-4">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    <a href="<?php echo site_url('register')?>">Register </a>
  </form>
</body>

</html>