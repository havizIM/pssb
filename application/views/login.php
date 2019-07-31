
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Login | PSSB</title>
  <link rel="apple-touch-icon" href="<?= base_url('assets') ?>/app-assets/images/home/logo_test.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets') ?>/app-assets/images/home/logo_test.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/vendors/css/forms/icheck/custom.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/app.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/pages/login-register.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('') ?>assets/css/style.css">

  <link rel="stylesheet" href="<?= base_url('assets/app-assets/vendors/js/sweetalert/sweetalert.css') ?>">

  <script src="<?= base_url('assets/app-assets/js/core/libraries/jquery.min.js') ?>"></script>

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

<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                      <img src="<?= base_url('assets') ?>/app-assets/images/home/logo_test.png" style="height: 200px" alt="branding logo">
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Login MTS Arizkan</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal form-simple" id="form_login">
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" class="form-control form-control-lg input-lg" id="nip" placeholder="NIP" name="nip">
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg input-lg" id="password" placeholder="Password" name="password">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                            <input type="checkbox" id="show_password">
                            <label for="remember-me"> Lihat Password</label>
                        </div>
                      </div>
                      <button type="submit" id="btn_login" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  <script src="<?= base_url('assets') ?>/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?= base_url('assets') ?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets') ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="<?= base_url('assets') ?>/app-assets/js/core/app-menu.js" type="text/javascript"></script>

  <script src="<?= base_url('assets') ?>/app-assets/js/core/app.js" type="text/javascript"></script>

  <script src="<?= base_url('assets/app-assets/vendors/js/sweetalert/sweetalert.min.js') ?>"></script>

  <script src="<?= base_url('assets/app-assets/vendors/js/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>

  <script src="<?= base_url('assets') ?>/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>

  <script type="text/javascript">

    $(document).ready(function(){

      $('#show_password').on('change', function(){
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
              $('#btn_login').addClass('disabled').attr('disabled', 'disabled').html('<i class="la la-spin la-spinner"></i>');
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
