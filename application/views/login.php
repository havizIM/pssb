<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/azia/img/azia-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>PSSB | Login</title>

    <!-- vendor css -->
    <link href="<?= base_url('assets') ?>/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets') ?>/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/azia.css">

    <link rel="stylesheet" href="<?= base_url('assets/lib/sweetalert/sweetalert.css') ?>">

    <script type="text/javascript">

      function cek_auth(){
        var session = localStorage.getItem('pssb')
        var auth = JSON.parse(session)

        if(session){
          window.location.replace('<?= base_url() ?>'+auth.level+'/')
        }
      }

      cek_auth();

    </script>

  </head>

  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <center> <img src="<?= base_url('assets/img/logo.png'); ?>" style="width: 80%;" alt="logo"> </center>
        <div class="az-signin-header">
          <form id="form_login">
            <div class="form-group">
              <label>NIP</label>
              <input type="text" class="form-control" placeholder="Masukkan NIP Anda" id="nip" name="nip">
            </div><!-- form-group -->

            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Masukkan Password Anda" id="password" name="password">
            </div><!-- form-group -->

            <div class="form-group row">
              <div class="col-md-12">
                <div class="d-flex no-block align-items-center">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input btn_show" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Lihat Password</label>
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-az-primary btn-block" type="submit" id="btn_login">Masuk</button>
          </form>
        </div><!-- az-signin-header -->
        <!-- <div class="az-signin-footer">
          <p><a href="">Forgot password?</a></p>
          <p>Don't have an account? <a href="page-signup.html">Create an Account</a></p>
        </div> -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="<?= base_url('assets') ?>/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/lib/ionicons/ionicons.js"></script>

    <script src="<?= base_url('assets/lib/sweetalert/sweetalert.min.js') ?>"></script>

    <script src="<?= base_url('assets/lib/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>

    <script src="<?= base_url('assets') ?>/js/azia.js"></script>
    <script>

    $(document).ready(function(){

      $('.btn_show').on('change', function(){
        var checked = $(this).prop('checked');

        if (checked) {
          $('#password').attr('type', 'text');
        } else {
          $('#password').attr('type', 'password');
        }
      });

      $('#form_login').on('submit', function(e){
        e.preventDefault();

        var nip = $('#nip').val();
        var password = $('#password').val();

        if(nip === '' || password === ''){
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Mohon diisi NIP dan Passwordnya',
            showConfirmButton: false,
            timer: 1500
          })
        } else {
          $.ajax({
            url: '<?= base_url('api/auth/login_user'); ?>',
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function(){
              $('#btn_login').addClass('disabled').attr('disabled', 'disabled').html('<i class="fa fa-fw fa-spinner fa-spin"></i>');
            },
            data: $('#form_login').serialize(),
            success: function(response){
              if(response.status === 200){
                localStorage.setItem('pssb', JSON.stringify(response.data));
                var link = '<?= base_url('') ?>'+response.data.level+'/'
                window.location.replace(link);
              } else {
                Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 1500
                })
                $('#btn_login').removeClass('disabled').removeAttr('disabled', 'disabled').text('Masuk');
              }
            },
            error: function(){
              Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Tidak dapat mengakses server',
                showConfirmButton: false,
                timer: 1500
              })
              $('#btn_login').removeClass('disabled').removeAttr('disabled', 'disabled').text('Masuk');
            }
          });
        }
      });

    });

    </script>
  </body>
</html>
