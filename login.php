<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Savings App</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="index2.html"><b>Admin</b>LTE</a> -->
    &nbsp
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="process.php" method="POST" onsubmit="processForm();">
        <div class="input-group mb-3">
          <input type="email" name="email" id="email-id" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password-id" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php 
          if(isset($_SESSION['error'])){

          
        ?>
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong><?php echo $_SESSION['error'];?></strong>
        
        </div>
        <?php }session_destroy(); ?>

        <div class="row">
         
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" id="login-btn" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        &nbsp
       
      </div>
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  // function processForm(){
  //   var x =  document.getElementById('email-id').value;
  //   var y =  document.getElementById('password-id').value;
  //   if(x != '' && y != ''){
  //     document.getElementById('login-btn').disabled=true;
  //     document.getElementById('login-btn').innerHTML='Authenticating....';
  //   }
  // }


//   $(document).ready(function() {
//     // show the alert
//     setTimeout(function() {
//         $(".alert").alert('close');
//     }, 2000);
//   });

</script>
</body>
</html>
