<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">

    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">

    <meta name="author" content="PIXINVENT">

    <title>Admin | PSSB</title>

    <link rel="apple-touch-icon" href="<?= base_url('assets') ?>/app-assets/images/ico/apple-icon-120.png">

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets') ?>/app-assets/images/ico/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">

    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/vendors.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/app.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/core/menu/menu-types/vertical-menu.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/app-assets/css/core/colors/palette-gradient.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url('') ?>assets/css/style.css">

    <link rel="stylesheet" href="<?= base_url('assets/app-assets/vendors/js/sweetalert/sweetalert.css') ?>">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.bootstrap4.min.css"/>

    <script type="text/javascript">

      var session = localStorage.getItem('pssb');
      var auth = JSON.parse(session);

      if(!session){
        window.location.replace('<?= base_url().'login' ?>');
      } else {
        if(auth.level !== 'admin'){
          window.location.replace('<?= base_url().'' ?>'+auth.level+'/');
        }
      }

    </script>

  </head>

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- NAVBAR -->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item">
              <a class="navbar-brand" href="index.html">
                <img class="brand-logo" alt="modern admin logo" src="<?= base_url('assets') ?>/app-assets/images/logo/logo.png">
                <h3 class="brand-text">Modern Admin</h3>
              </a>
            </li>
            <li class="nav-item d-md-none">
              <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
            </li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav float-right">
              <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                  <span class="mr-1">Assalamualaikum,
                    <span class="user-name text-bold-700">John Doe</span>
                  </span>
                  <span class="avatar avatar-online">
                    <img src="<?= base_url('assets') ?>/app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="ft-user"></i> Informasi User</a>
                  <a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a>
                  <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a>
                  <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>
                </div>
              </li>
              <li class="dropdown dropdown-notification nav-item">
                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-settings"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" id="btn_ganti"><i class="ft-lock"></i> Ganti Password</a>
                  <a class="dropdown-item" id="btn_logout"><i class="ft-power"></i> Logout</a>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- SIDEBAR-->
    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
      <div class="main-menu-content">
        <ul class="navigation navigation-main">
          <li class=" nav-item"><a href="#/dashboard"><i class="la la-home"></i><span class="menu-title">Dashboard</span></a></li>

          <li class=" nav-item"><a href="#/user"><i class="la la-user"></i><span class="menu-title">User</span></a></li>
        </ul>
      </div>
    </div>

    <div class="app-content content">
      <div class="content-wrapper" id="content">

      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow fixed-bottom">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block">PSSB </span>
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">2019 <i class="ft-heart pink"></i></span>
      </p>
    </footer>

    <div class="modal fade text-left" id="modal_ganti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel35"> Ganti Password</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form_ganti">
            <div class="modal-body">
              <fieldset class="form-group floating-label-form-group">
                <label for="title">Password Lama</label>
                <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
              </fieldset>
              <br>

              <fieldset class="form-group floating-label-form-group">
                <label for="title">Password Baru</label>
                <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password Baru">
              </fieldset>
              <br>

              <fieldset class="form-group floating-label-form-group">
                <label for="title">Konfirmasi Password</label>
                <input type="password" class="form-control" id="re_password" placeholder="Konfirmasi Password">
              </fieldset>
              <br>
            </div>
            <div class="modal-footer">
              <button type="submit" id="submit_ganti" class="btn btn-outline-primary btn-lg">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="<?= base_url('assets') ?>/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

    <script src="<?= base_url('assets') ?>/app-assets/js/core/app-menu.js" type="text/javascript"></script>

    <script src="<?= base_url('assets') ?>/app-assets/js/core/app.js" type="text/javascript"></script>

    <script src="<?= base_url('assets') ?>/app-assets/js/scripts/customizer.js" type="text/javascript"></script>

    <script src="<?= base_url('assets/app-assets/vendors/js/sweetalert/sweetalert.min.js') ?>"></script>

    <script src="<?= base_url('assets/app-assets/vendors/js/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>

    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    <script type="text/javascript">

      function load_content(link){

        $.get(`<?= base_url('admin/'); ?>${link}`, function(response){
          $('#content').html(response);
        })
      }

      $(document).ready(function(){

        var link;

        if(location.hash){
          link = location.hash.substr(2);
          load_content(link);
        } else {
          location.hash = '#/dashboard'
        }

        $(window).on('hashchange', function(){
          link = location.hash.substr(2);
          load_content(link)
        })

        $('#btn_logout').on('click', function(){
          Swal.fire({
            title: 'Apa Anda yakin ingin keluar?',
            type: 'question',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Saya yakin.',
            showLoaderOnConfirm: true
          }).then((result) => {
            if(result.value){
              $.ajax({
                url: '<?= base_url('api/auth/logout_user/') ?>'+auth.token,
                type: 'GET',
                dataType: 'JSON',
                success: function(response){
                  localStorage.clear();
                  window.location.replace('<?= base_url().'auth' ?>');
                }
              })
            }
          })
        })

        $('#btn_ganti').on('click', function(){
          $('#modal_ganti').modal('show');
        });

        $('#form_ganti').on('submit', function(e){
          e.preventDefault();

          var password_lama = $('#password_lama').val();
          var password_baru = $('#password_baru').val();
          var re_password = $('#re_password').val();

          if(password_lama === '' || password_baru === '') {
            Swal.fire({
              position: 'center',
              type: 'warning',
              title: 'Data tidak boleh kosong',
              showConfirmButton: false,
              timer: 1500
            });
          } else if (password_baru !== re_password) {
            Swal.fire({
              position: 'center',
              type: 'warning',
              title: 'Password belum sama',
              showConfirmButton: false,
              timer: 1500
            });
          } else {
            $.ajax({
              url: '<?= base_url('api/auth/password_user/') ?>'+auth.token,
              type: 'POST',
              dataType: 'JSON',
              beforeSend: function(){
                $('#submit_ganti').addClass('disabled').attr('disabled', 'disabled').html('<i class="la la-spin la-spinner"></i>');
              },
              data: {
                password_lama: password_lama,
                password_baru: password_baru
              },
              success: function(response){
                if(response.status === 200){
                  Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                  $('#form_ganti')[0].reset();
                  $('#modal_ganti').modal('hide');
                } else {
                  Swal.fire({
                    position: 'center',
                    type: 'warning',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                }
                $('#submit_ganti').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan')
              },
              error: function(){
                Swal.fire({
                  position: 'center',
                  type: 'warning',
                  title: 'Tidak dapat mengakses server',
                  showConfirmButton: false,
                  timer: 1500
                });
                $('#submit_ganti').removeClass('disabled').removeAttr('disabled', 'disabled').text('Simpan')
              }
            });
          }
        });

      });

    </script>

  </body>

</html>
