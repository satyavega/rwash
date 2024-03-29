<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RWash - Laundry Terbaik di Hidupmu!
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  {{-- <link href="{{ asset('assets/img/logos.svg') }}" rel="apple-touch-icon"> --}}
  <link href="{{ asset('assets/img/logos.svg') }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<style>
#pricing {
    background-image: url('{{ asset('assets/img/hero-bg.jpg') }}');
    background-size: cover;
    position: relative;
}

#pricing::after {
    content: "";
    position: absolute;
    bottom: 0;
    top: 0;
    left: 0;
    right: 0;
}
#pricing {
    position: relative;
    overflow: hidden; /* Agar overlay tidak keluar dari section */
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8); /* Warna dan opasitas yang Anda inginkan */
    z-index: 1; /* Letakkan di bawah gambar latar belakang */
}

#pricing .container {
    position: relative;
    z-index: 2; /* Letakkan di atas overlay */
}
</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="#">RWash</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li class="nav-link scrollto">
            @if (Auth::check())
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex gap-2 align-items-center">
                        <i class="bi bi-person-circle"></i>
                        <span>profile</span>
                    </div>

                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            @else
                <a class="btn-get-started scrollto" href="{{ url('login') }}">Login</a>
            @endif
            </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <h1>RWash</h1>
          <h2>Mau Cuci Bersih Wangy Wangy? Ayo Join Member</h2>
        </div>
      </div>
      <div class="text-center">
         <a href="/register" class="btn-get-started btn-outline-primary scrollto">Mulai Jadi Member</a>
      </div>

      <div class="row icon-boxes">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="ri-speed-mini-fill"></i></div>
              <h4 class="title"><a href="">Cepat</a></h4>
              <p class="description">Doi slow response? Hubungi kami maka kami akan balas chat anda secepatnya!</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                  <div class="icon"><i class="ri-medal-fill"></i></div>
                  <h4 class="title"><a href="">Berkualitas</a></h4>
                  <p class="description">Pengen yang ada kualitas disini aja jangan ditempat lain</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="400">
                <div class="icon-box">
                    <div class="icon"><i class="ri-bubble-chart-fill"></i></div>
                    <h4 class="title"><a href="">Wangi</a></h4>
                    <p class="description">Barang kamu dijamin wangi jadi se-wangy waifumu!</p>
                </div>
            </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="500">
          <div class="icon-box">
            <div class="icon"><i class="ri-discount-percent-fill"></i></div>
            <h4 class="title"><a href="">Murah</a></h4>
            <p class="description">Mau nyuci murah tapi ga murahan? RWASH AJA!!!</p>
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Kenali Lebih Dekat RWash</h2>
            <p>Lebih dari Sekadar Laundry, Kami adalah Mitra Anda dalam Menjaga Waktu dan Kualitas Hidup.</p>
          </div>

          <div class="row content">
            <div class="col-lg-6">
              <h3>Mengapa Memilih RWash?</h3>
              <p>
                  Di RWash, kami tidak hanya tentang mencuci pakaian - kami tentang membebaskan waktu Anda. Kami mengerti bahwa setiap menit dalam hidup Anda berharga, dan kami ada di sini untuk membantu Anda mengoptimalkan setiap detiknya.
              </p>
              <ul>
                <li><i class="ri-check-double-line"></i> <strong>Layanan Cepat dan Mudah:</strong> Layanan pengambilan dan pengantaran yang efisien untuk menjadikan hari Anda lebih produktif.</li>
                <li><i class="ri-check-double-line"></i> <strong>Lingkungan Ramah:</strong> Kami menggunakan metode yang berkelanjutan dan ramah lingkungan untuk setiap cucian.</li>
                <li><i class="ri-check-double-line"></i> <strong>Pelayanan Personal:</strong> Tim kami selalu siap untuk membantu dengan setiap kebutuhan atau pertanyaan Anda.</li>
              </ul>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
              <h3>Menyempurnakan Gaya Hidup Anda</h3>
              <p>
                  Setiap pakaian yang kami tangani adalah kesempatan bagi kami untuk memberikan lebih. Lebih dari sekadar kebersihan, kami menawarkan kenyamanan dan ketenangan pikiran. Nikmati hidup tanpa kekhawatiran laundry, karena RWash ada untuk mengurusnya.
              </p>
              <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
          </div>

        </div>
      </section>
      <!-- End About Section -->

    <!-- ======= tampilkan total member dll ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <span data-purecounter-start="0" data-purecounter-end="{{ $totalMembers }}" data-purecounter-duration="2" class="purecounter"></span>
              <p>Happy Member</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <span data-purecounter-start="0" data-purecounter-end="{{ $totalTransactions }}" data-purecounter-duration="2" class="purecounter"></span>
              <p>Transaksi</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <span data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="2" class="purecounter"></span>
              <p>Tahun Pengalaman Kami</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= About Video Section ======= -->
    <section id="about-video" class="about-video">
      <div class="container" data-aos="fade-up">
        <div class="row align-items-center">
            <div class="col-lg-6 video-box p-0 " data-aos="fade-right" data-aos-delay="100">
                <img src="assets/img/testimonials/laundry-unsplash1.jpg" class="img-fluid hover-zoom" alt="">
            </div>

            <div class="col-lg-6 content p-4" data-aos="fade-left" data-aos-delay="100">
                <div>
                    <h2><strong>RWASH JARGONNYA???</strong></h2>
                </div>
                <div class="">
                    <ul style="font-size: 18px;">
                        <li><i class="bx bx-check-double"></i> Kilauan Kebersihan, Sentuhan Kelembutan.</li>
                        <li><i class="bx bx-check-double"></i> Ubah Rutinitas Menjadi Kenyamanan.</li>
                        <li><i class="bx bx-check-double"></i> Ketika Kebersihan Bertemu Kemudahan, Itulah Kami.</li>
                        <li><i class="bx bx-check-double"></i> Menjaga Kecerahan Warna, Menyempurnakan Hatimu.</li>
                    </ul>
                </div>
            </div>

        </div>
      </div>
    </section><!-- End About Video Section -->


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testimoni</h2>
          <h3><strong>Apa yang Pelanggan Kami Katakan Tentang RWash?</strong></h3>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @foreach($complaints as $testimonial)
            <div class="swiper-slide">
                <div class="testimonial-item ">
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        {{ $testimonial->body }}
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                        <img src="{{ asset('storage/images/' . $testimonial->user->profile_picture) }}" class="rounded-circle object-fit-cover" alt="" style="width: 150px; height: 150px;">
                    <h3>{{ $testimonial->user->name }}</h3>
                    <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      </div>
                </div>
            </div>
            <!-- End testimonial item -->
        @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>
    <!-- End Testimonials Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pelayanan</h2>
          <p>RWash bisa ngasih pelayanan apa aja sih?</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                </svg>
                <i class="ri-hotel-fill"></i>
              </div>
              <h4><a href="">Pencucian Linen Komersial </a></h4>
              <p>Untuk bisnis seperti hotel, restoran, atau rumah sakit, yang membutuhkan pencucian linen dalam jumlah besar.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box iconbox-orange ">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                </svg>
                <i class="ri-speed-up-fill"></i>
            </div>
              <h4><a href="">Layanan Ekspress</a></h4>
              <p>Layanan cepat untuk pencucian dalam waktu singkat, biasanya dengan biaya tambahan.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-pink">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                </svg>
                <i class="ri-shirt-fill"></i>
              </div>
              <h4><a href="">Cuci Setrika</a></h4>
              <p>Pakaian dicuci, dikeringkan, dilipat, dan setrika kamu dapat langsung memakai pakaianmu. </p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box iconbox-yellow">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
                </svg>
                <i class="ri-truck-fill"></i>
              </div>
              <h4><a href="">Layanan Konsultasi dan Edukasi</a></h4>
              <p>Di RWash laundry, Kami dapat memberikan saran perawatan untuk pakaian dan tekstil, termasuk panduan mencuci dan merawat agar tahan lama dan berkualitas.
              </p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box iconbox-red">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572"></path>
                </svg>
                <i class="ri-user-star-fill"></i>
              </div>
              <h4><a href="">Layanan Langganan Member</a></h4>
              <p>Untuk mendapatkan banyak keuntungan laundry kami menawarkan model member.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-teal">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                </svg>
                <i class="ri-file-list-3-fill"></i>
              </div>
              <h4><a href="">Pencucian Spesifik</a></h4>
              <p>Di RWash Laundry, menyediakan pencucian khusus untuk item tertentu seperti karpet, tirai, selimut, dan pakaian berbahan khusus.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Sevices Section -->
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="overlay"></div> <!-- Tambahkan overlay di dalam section -->

      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>MEMBERSHIP</h2>
          <p>Dapatkan banyak Keuntungan Hanya dengan Ceban Kembali Cepe!</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6" data-aos="zoom-im" data-aos-delay="100">
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="100">
            <div class="box featured">
              <h3>MEMBER</h3>
              <h4><sup>Rp.</sup>9.900,00<span> / Bulan</span></h4>
              <ul>
                <li>Prioritas</li>
                <li>Voucher Khusus Member</li>
                <li>Pelayanan Khusus Member</li>
                <li>Gratis Biaya Priotias Setiap Bulan</li>
              </ul>
              <div class="btn-wrap">
                <a href="/register" class="btn-buy">Gabung Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
          </div>

        </div>

      </div>
    </section>
    <!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pertanyaan yang sering ditanyakan</h2>
          <p>Mungkin kalian masih ragu untuk menjadi member di Rwash ini karena adanya trust issue kali yah- Tenang, kami bakalan bantu jawab yang mungkin kalian tanyain kok!!</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">"Bersih ga? Aman ga? Takutnya pake bahan yang ngerusak baju!" <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                    Tenang kak, Kami disini menggunakan bahan yang berkualitas dan gabakalan ngecewain deh pokoknya, kalo soal bersih mah JANGAN DITANYA LAGIEE!!
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">"Pelayanannya bagus ga? Percuma aja kalau tempat bagus tapi pelayanan nihil.."<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                    Kami tau banget kualitas pelayanan adalah hal yang sangat penting. Di RWash, kami tidak hanya fokus pada kualitas fasilitas kami, tapi juga sangat serius dalam menyediakan pelayanan terbaik. Kami memiliki tim yang terlatih dan berdedikasi tinggi untuk memastikan setiap pelanggan mendapatkan pengalaman terbaik.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">"Apa ada kebijakan kalau ada kejadian rusak atau hilangnya barang?" <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                    Selama ini memang masih belum ada kejadian yang mengharuskan kami melakukan kebijakan itu, dikarenakan kami memang sangat menjaga barang milik customer kami. Tetapi jika itu terjadi, pihak RWash siap bertanggung jawab sepenuhnya atas kesalahan dari kami!
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">"Emangnya kalo jadi member untungnya apasih?" <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                    Untungnya sih,... BANYAK BANGET!! Dimulai dari adanya voucher yang bisa ngasih potongan harga, voucher khusus pengguna GoJek, dan potongan di setiap akhir bulan! Makanya <a href="/register">JOIN SEKARANG!! </a>
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">"Rumah saya jauh, pasti mahal biaya ongkosnya."<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                  <p>
                      Ketika kakak pertama kali melakukan transaksi di RWash, kakak bakalan dapet potongan ongkir lohhh! Kapan lagi coba?~~
                  </p>
                </div>
              </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Beritahu Kami!</h2>
          <p>Dibawah ini adalah kontak kami yang siap menerima kritik dan saran dari pelanggan, kami akan sangat menghargainya. </p>
        </div>

        <div>
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.2230754405466!2d106.88359051822967!3d-6.903481013866991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6836461765044f%3A0xffc0309c6f44fdbb!2sWarung%20Nasi%20Hj.%20Ecin%20Saputra!5e0!3m2!1sid!2sid!4v1704940970926!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Jl. Cagak no.6969, RT. 06, RW. 09</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>rwashofficial@gmail.com</p>
              </div>

              <div class="phone">
                <a href="https://wa.me/628699669690"><i class="bi bi-phone"></i></a>
                <h4>Call:</h4>
                <p>+628 699669690</p>
              </div>

            </div>

          </div>



        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>RWash</h3>
            <p>
            Jl. Cagak no.6969, RT. 06, RW. 09, Sukabumi<br>
              <strong>Phone:</strong> +628 699669690<br>
              <strong>Email:</strong> rwashofficial@gmail.com<br>
            </p>
          </div>


        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>RWash</span></strong>. All Rights Reserved
        </div>

      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://twitter.com/X26Code" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://web.facebook.com/PrajaAnime.satyavega" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/ohmy.shin_/" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="https://github.com/satyavega" class="github"><i class="bx bxl-github"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
