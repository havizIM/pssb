<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Dashboard</h3>
    
  </div>
</div>
<div class="content-body">
  <section id="crypto-stats-2">
    <div class="row">
      <div class="col-md-8">
        <div class="bs-callout-success callout-border-left callout-round callout-transparent mt-1 p-2 py-1">
          <h1 style="letter-spacing:20px;">Selamat datang </h1>
          <h3>Sistem informasi pendaftaran siswa siswi baru</h3>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-gradient-directional-success">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="la la-user text-white float-left" style="font-size:60px;"></i>
                </div>
                <div class="media-body text-white text-right">
                  <h1 class="text-white" id="data1">0</h1>
                  <h3>Total Kriteria</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card bg-gradient-directional-danger">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="la la-user text-white float-left" style="font-size:60px;"></i>
                </div>
                <div class="media-body text-white text-right">
                  <h1 class="text-white" id="data2">0</h1>
                  <h3>Total Jadwal</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card bg-gradient-directional-info">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="align-self-center">
                  <i class="la la-user text-white float-left" style="font-size:60px;"></i>
                </div>
                <div class="media-body text-white text-right">
                  <h1 class="text-white" id="data3">0</h1>
                  <h3>Total Pendaftaran</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>



<script type="text/javascript">
  $(document).ready(function() {

    var session = localStorage.getItem('pssb');
    var auth = JSON.parse(session);
    var token = auth.token

    var data1 = `<?= base_url().'api/kriteria/show/' ?>${token}`
    var data2 = `<?= base_url().'api/seleksi/show/' ?>${token}`
    var data3 = `<?= base_url().'api/pendaftaran/show/' ?>${token}`

    $.ajax({
      url: data1,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $('#data1').text(response.data.length)
      },
      error:function(){}
    });


    $.ajax({
      url: data2,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $('#data2').text(response.data.length)
      },
      error:function(){}
    });

    $.ajax({
      url: data3,
      type: 'GET',
      dataType: 'JSON',
      // data: {},
      // beforeSend:function(){},
      success:function(response){
        $('#data3').text(response.data.length)
      },
      error:function(){}
    });

  });
</script>
