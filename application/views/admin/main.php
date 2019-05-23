
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

    <title>PSSB | Admin</title>

    <!-- vendor css -->
    <link href="<?= base_url('assets')  ?>/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')  ?>/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')  ?>/lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="<?= base_url('assets')  ?>/lib/morris.js/morris.css" rel="stylesheet">
    <link href="<?= base_url('assets')  ?>/lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?= base_url('assets')  ?>/lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="<?= base_url('assets')  ?>/css/azia.css">

    <link rel="stylesheet" href="<?= base_url('assets/lib/sweetalert/sweetalert.css') ?>">

    <script src="<?= base_url('assets') ?>/lib/jquery/jquery.min.js"></script>

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

    <style media="screen">

      .btn-add {
        margin-left: 750px;
        margin-top: -6px;
      }
    </style>

  </head>

  <body class="az-body az-body-sidebar az-light">

    <div class="az-sidebar">
      <div class="az-sidebar-header">
        <a href="index.html" class="az-logo">az<span>i</span>a</a>
      </div><!-- az-sidebar-header -->
      <div class="az-sidebar-loggedin">
        <div class="az-img-user online"><img src="https://via.placeholder.com/500x500" alt=""></div>
        <div class="media-body">
          <h6>Aziana Pechon</h6>
          <span>Premium Member</span>
        </div><!-- media-body -->
      </div><!-- az-sidebar-loggedin -->
      <div class="az-sidebar-body">
        <ul class="nav">
          <li class="nav-label">Main Menu</li>
          <li class="nav-item active">
            <a href="#/dashboard" class="nav-link"><i class="typcn typcn-clipboard"></i>Dashboard</a>
          </li><!-- nav-item -->

          <li class="nav-item">
            <a href="#/user" class="nav-link"><i class="typcn typcn-group-outline"></i>User</a>
          </li>
        </ul><!-- nav -->
      </div><!-- az-sidebar-body -->
    </div><!-- az-sidebar -->
    <div class="az-content az-content-dashboard-five">
      <div class="az-header">
        <div class="container-fluid">
          <div class="az-header-left">
            <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
          </div><!-- az-header-left -->

          <div class="az-header-right">
            <div class="dropdown az-profile-menu">
              <a href="" class="az-img-user"><img src="https://via.placeholder.com/500x500" alt=""></a>
              <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                  <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                  <div class="az-img-user">
                    <img src="https://via.placeholder.com/500x500" alt="">
                  </div><!-- az-img-user -->
                  <h6>Aziana Pechon</h6>
                  <span>Premium Member</span>
                </div><!-- az-header-profile -->

                <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="" id="btn_ganti" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Ganti Password</a>
                <a id="btn_logout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
              </div><!-- dropdown-menu -->
            </div>
          </div><!-- az-header-right -->
        </div><!-- container -->
      </div><!-- az-header -->

      <div class="page-wrapper" id="content">

      </div>

      <div class="az-footer">
        <div class="container-fluid">
          <span>&copy; 2018 Azia Responsive Bootstrap 4 Dashboard Template</span>
          <span>Designed by: ThemePixels</span>
        </div><!-- container -->
      </div><!-- az-footer -->
    </div><!-- az-content -->

    <div id="modal_ganti" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">Ganti Password</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" id="form_ganti">
            <div class="modal-body">
              <div class="form-group">
                <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Password Lama">
              </div>

              <div class="form-group">
                <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Password Baru">
              </div>

              <div class="form-group">
                <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Konfirmasi Password">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" id="submit_ganti" class="btn btn-indigo">Simpan</button>
            </div>
          </form>
        </div>
      </div><!-- modal-dialog -->
    </div>

    <script src="<?= base_url('assets') ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets') ?>/lib/ionicons/ionicons.js"></script>
    <script src="<?= base_url('assets') ?>/lib/jquery.flot/jquery.flot.js"></script>
    <script src="<?= base_url('assets') ?>/lib/jquery.flot/jquery.flot.pie.js"></script>
    <script src="<?= base_url('assets') ?>/lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url('assets') ?>/lib/chart.js/Chart.bundle.min.js"></script>

    <script src="<?= base_url('assets') ?>/js/azia.js"></script>
    <script src="<?= base_url('assets') ?>/js/chart.flot.sampledata.js"></script>

    <script src="<?= base_url('assets/lib/sweetalert/sweetalert.min.js') ?>"></script>

    <script src="<?= base_url('assets/lib/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>

    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    <script>

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
                $('#submit_ganti').addClass('disabled').attr('disabled', 'disabled').html('<i class="fa fa-fw fa-spinner fa-spin"></i>');
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
                $('#submit_ganti').removeClass('disabled').removeAttr('disabled', 'disabled').text('Ganti')
              },
              error: function(){
                Swal.fire({
                  position: 'center',
                  type: 'warning',
                  title: 'Tidak dapat mengakses server',
                  showConfirmButton: false,
                  timer: 1500
                });
                $('#submit_ganti').removeClass('disabled').removeAttr('disabled', 'disabled').text('Ganti')
              }
            });
          }
        });

        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e){
          e.stopPropagation();

          // closing of sidebar menu when clicking outside of it
          if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
              $('body').removeClass('az-sidebar-show');
            }
          }
        });

        $('#azSidebarToggle').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('.az-sidebar').toggle();
          } else {
            $('body').toggleClass('az-sidebar-show');
          }
        })

      });

    </script>
  </body>
</html>
