<?php

include('./includes/header.php');
session_start();
?>

<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-6 col-lg-6 col-md-6">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">

            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  <?php
                  if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

                    echo '<div class="alert-danger"> ' . $_SESSION['status'] . ' </div>';
                    unset($_SESSION['status']);
                  }
                  ?>
                </div>


                <form class="user" action="code.php" method="POST">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address...">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                  </div>

                  <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block">
                    登入
                  </button>

                  <a class="btn btn-outline-primary waves-effect btn-user btn-block" href="../index.php">
                    回首頁
                  </a>
                  <hr>
                </form>


                <div class="text-center">
                  <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="register.html">Create an Account!</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>

  </div>
  <?php include('./includes/footer.php'); ?>
</div>




<?php

include('./includes/scripts.php');



?>