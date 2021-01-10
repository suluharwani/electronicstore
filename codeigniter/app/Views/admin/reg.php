<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url('assets/sbadmin')?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- <link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet"> -->

  <!-- Custom styles for this template-->
  <link href="<?=base_url('assets/sbadmin')?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat akun!</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="nama_depan"
                    placeholder="Nama Depan" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                    name="nama_belakang" placeholder="Nama Belakang" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username"
                  placeholder="Username" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password"
                    id="password" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user"
                    id="confirm_password" placeholder="Ulangi Password" required>
                  </div>
                </div>
                <div class="text-center">
                  <span id="password_result"></span>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="nama_toko"
                    id="nama_toko" placeholder="Nama Toko" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="alamat_toko"
                    id="alamat_toko" placeholder="Alamat Toko" required>
                  </div>
                </div>
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-user btn-block">
                  Register
                </button>
                <hr>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url('assets/sbadmin')?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/sbadmin')?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url('assets/sbadmin')?>/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url('assets/sbadmin')?>/js/sb-admin-2.min.js"></script>

</body>

</html>
<script>

$(document).ready(function(){
  $('#confirm_password,#password').keyup(function(){
    var confirm_password = $('#confirm_password').val();
    var password = $('#password').val();
    if(confirm_password != '' && password !=''){
      $.ajax({
        url: "<?php echo base_url(); ?>/index.php/admin/check_password",
        method: "POST",
        data: {confirm_password:confirm_password, password:password},
        success: function(data){
          $('#password_result').html(data);
        }
      });
    }
  });

});
</script>
