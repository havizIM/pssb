<style>
  .img-fluid.school {
    height: 650px;
  }

.left-part {
  width: 50%;
  padding: 55px;
}

.lead.justify{
  text-align: justify;
  text-indent: 50px;
}

#body {
      padding-top: 150px;
}

.section-title {
  margin-bottom: 80px;
}

.card.bg-primary, .card.bg-facebook, .card.bg-linkedin {
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
}

#body-2 {
    padding-top: 150px;
}

.content.bg-body2 {
  background-image:url('<?= base_url('assets') ?>/app-assets/images/home/smp2.jpg');
  height: 400px;
  width: 100%;
  background-repeat: no-repeat;
  background-position: fixed;
  background-size:cover;
  background-attachment: fixed;
}
</style>
 <!-- Button animation start -->
        <section id="home" class="">
        
          <div class="col-lg-12 d-flex align-items-center">
            <div class="left-part">
              <div class="selected">
                  <h2 class="text-bold-600">Yayasan Pendidikan Islam</h2>
                  <h3 class="text-muted mb-1">
                    <em>MTS AR-Rizkan</em>
                  </h3>
                  <p class="lead justify">
                    Madrasah Tsanawiyah AR-Rizkan Ibnu Safiudin Juhut merupakan lembaga pendidikan jenjang dasar pada pendidikan formal di Indonesia setara dengan Sekolah Menengah Pertama, kurikulum MTS Ar-Rizkan sama dengan kurikulum Sekolah Menengah Pertama, hanya saja pada porsi MTS terdapat porsi lebih banyak mengenai pendidikan agama Islam juga mengajarkan mata pelajaran sebagaimana di sekolah umum lainnya.
                  </p>
              </div>
              
            </div>
            <div class="right-part">
             <img class="img-fluid school" src="<?= base_url('assets') ?>/app-assets/images/home/school.svg" alt="">
            </div>
          </div>
        </section>
        <!-- Button animation end-->

        <!-- Collapse animation start-->
        <section id="body" class="clpsAnimation">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                  <h2 class="text-bold-600">Layanan</h2>
                  <p>Yayasan Pendidikan Islam Rizkhan  Ibnu Safiudin Juhut memiliki beberapa layanan utama yang dapat dinikmati siswa/i kami saat melakukan kegiatan ajar mengajar dan aktivitas lainnya.
                  </p>
                </div>
            </div>
          </div>
         
            <div class="row">
                <div class="col-xl-4 col-md-12">
                  <div class="card bg-twitter white">
                    <div class="card-content p-2">
                      <div class="card-body">
                        <div class="text-center mb-1">
                          <i class="la la-soccer-ball-o font-large-3"></i>
                          <h4 class="text-bold-600 white">Fasilitas Olahraga</h4>
                        </div>
                        <div class="tweet-slider carousel slide text-center" data-ride="carousel">
                          <div class="carousel-inner">
                            <div class="carousel-item active carousel-item-left">
                              <p>Kolam renang, Lap. Basket semi indoor,</p>
                            </div>
                            <div class="carousel-item carousel-item-next carousel-item-left">
                              <p>Tenis Meja, Lap. Volly, Lap. Futsal,</p>
                            </div>
                            <div class="carousel-item">
                              <p>Lap. Bulu Tangkis, Lap. Sepak Bola,</p>
                            </div>
                            <div class="carousel-item">
                              <p> Lap. Tennis, Soft Ball, Athletic Track.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-md-12">
                  <div class="card bg-facebook white">
                    <div class="card-content p-2">
                      <div class="card-body">
                        <div class="text-center mb-1">
                          <i class="la la-bank font-large-3"></i>
                          <h4 class="text-bold-600 white">Fasilitas Sekolah</h4>
                        </div>
                        <div class="fb-post-slider carousel slide text-center" data-ride="carousel">
                          <div class="carousel-inner">
                            <div class="carousel-item">
                              <p>Tiap kelas Memiliki AC</p>
                            </div>
                            <div class="carousel-item active">
                              <p>Kuota kelas 25 orang dan dilengkapi dengan smart board untuk pembelajaran</p>
                            </div>
                            <div class="carousel-item">
                              <p>Laboratorium lengkap: IPA, Bahasa, Komputer & Perpustakaan.</p>
                            </div>
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-md-12">
                  <div class="card bg-linkedin white">
                    <div class="card-content p-2">
                      <div class="card-body">
                        <div class="text-center mb-1">
                          <i class="la la-sticky-note font-large-3"></i>
                          <h4 class="text-bold-600 white">Lainnya</h4>
                        </div>
                        <div class="linkedin-post-slider carousel slide text-center" data-ride="carousel">
                          <div class="carousel-inner">
                            <div class="carousel-item carousel-item-next carousel-item-left">
                              <p>Setiap siswa/i mendapat makan saat jam istirahat</p>
                            </div>
                            <div class="carousel-item">
                              <p>Pembagian snack disetiap jam istirahat</p>
                            </div>
                            <div class="carousel-item active carousel-item-left">
                              <p>Masjid sebagai pusat pembelajaran Kompetensi Agama Islam</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Collapse animation end -->

        <!-- Alert animation start -->
        <section id="body-2" class="alertAnimation">
          <div class="content bg-body2">
            <div class="row">
              <div class="col-md-12">

              </div>
            </div>
          </div>
        </section>
        <!-- Alert animation end -->

        <!-- Callout animation start-->
        <section id="calloutAnimation" class="calloutAnimation">
         
        </section>
        <!-- Callout animation end -->

        <!-- Card animation start -->
        <section id="cardAnimation" class="cardAnimation">
        
        </section>
        <!-- Card animation end -->

<script>

</script>