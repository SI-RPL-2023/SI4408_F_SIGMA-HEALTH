<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSUD Maulana AK. Baturaja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('assets/login/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/login/css/style.css')}}">

    <!-- Pendaftaran pasien -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,900&display=swap" rel="stylesheet">
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.css">
      <!-- Datatables -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/adminlte/datetimepicker-master/jquery.datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/summernote/summernote-bs5.min.css')}}">
<style>
    body, html{
        font-family: 'Poppins', sans-serif;
        background: #F9F9F9;
    }
    footer {
      background : #285430;
    }
    footer a {
      color: #D0D0D0;
      text-decoration: none;
      transition: all 0.3s;
    }

    footer a:hover{
        color: #5F8D4E;
    }

    img {
      max-width: 100%;
      height: auto;
    }
    .link-navbar{
        color: #fff;
    }
    .link-navbar:hover{
      color: #5F8D4E;
      /* text-decoration: underline; */
    }

    .socials li{
        background:#3A7745;
        border-radius:50px;
        margin-left: 15px;
    }
    .socials li a i{
        font-size: 18px;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        border-bottom: 3px solid #0D9737;
        background: #F9F9F9;
        color: #285430;
    }

    #myBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }


</style>
</head>
<body>
<button onclick="topFunction()" id="myBtn" class="btn btn-success rounded-circle" title="Go to top"><i class="bi bi-arrow-up-short"></i></button>
<nav class="navbar navbar-expand-lg" style="background:#285430;">
  <div class="container">
    <a class="navbar-brand" href="/" style="font-size:15px;color:#fff">
      <div class="d-flex justify-content-between">
        <img src="{{asset('assets/images/logo1.png')}}" alt="Logo" width="64" height="60" class="">
        <span class="ms-2 mt-2">RUMAH SAKIT UMUM DR MAULANA AK.<br>BATURAJA</span>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @if(Session::get('login') == null)
    @else
    @if(Session::get('role') == 'pasien')
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{url('pendaftaran-pasien')}}" class="nav-link link-navbar">Pendaftaran</a>
            </li>
        </ul>
    </div>
    @elseif(Session::get('role') == 'admin')
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{url('home-admin')}}" class="nav-link link-navbar">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{url('master-poli')}}" class="nav-link link-navbar">Master Poli</a>
            </li>
            <li class="nav-item">
                <a href="{{url('master-dokter')}}" class="nav-link link-navbar">Master Dokter</a>
            </li>
            <li class="nav-item">
                <a href="{{url('master-jadwal')}}" class="nav-link link-navbar">Master Jadwal</a>
            </li>
            <li class="nav-item">
                <a href="{{url('master-obat')}}" class="nav-link link-navbar">Master Obat</a>
            </li>
            <li class="nav-item">
                <a href="{{url('cek-reservasi-pasien')}}" class="nav-link link-navbar">Cek Reservasi</a>
            </li>
        </ul>
    </div>
    @endif
    @endif
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                @if(Session::get('login') == null)
                <a href="{{url('login')}}" class="nav-link fw-semibold link-navbar">Log in</a>
                @else
                <a href="{{url('doLogout')}}" class="nav-link fw-semibold link-navbar">Log out</a>
                @endif
            </li>
        </ul>
    </div>
  </div>
</nav>  
@yield('content')
<!-- FOOTER -->
<div class="d-flex flex-column mt-4">
  <footer class="w-100 py-4 flex-shrink-0">
        <div class="container py-4">
            <div class="row gy-4 gx-5">
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-3">Tautan</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Karir</a></li>
                        <li><a href="#">Saran & Kritik</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="text-white mb-3">Lainnya</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#">Sitemap</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Disclaimer</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- <img src="{{asset('assets/images/maps.png')}}" alt=""> -->
                    <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=telkom%20university+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">area maps</a></iframe></div>
                </div>
            </div>
            <div class="social-login">
                <ul class="socials">
                    <li><a href="#"><i class="display-flex-center bi bi-twitter"></i></a></li>
                    <li><a href="#"><i class="display-flex-center bi bi-facebook"></i></a></li>
                    <li><a href="#"><i class="display-flex-center bi bi-instagram"></i></a></li>
                    <li><a href="#"><i class="display-flex-center bi bi-youtube"></i></a></li>
                </ul>
            </div>
            <hr class="border border-1 opacity-50" style="border-color:#fff">
            <p style="color: #D0D0D0">
                © Copyright 2022 | Rumah Sakit Umum dr. Maulana AK. All Rights Reserved<br>
                Designed by Tim Pengembang RSU dr. Maulana AK
            </p>
        </div>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="{{asset('assets/login/js/main.js')}}"></script>
<script src="{{asset('assets/pendaftaran/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/pendaftaran/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="{{asset('assets/adminlte/datetimepicker-master/jquery.datetimepicker.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->
<script src="{{asset('assets/adminlte/plugins/chart.js/Chart.js')}}"></script>
<script src="{{asset('assets/adminlte/plugins/summernote/summernote-bs5.min.js')}}"></script>
<script>  
$(document).ready(function(){
    $('.toast').toast('show');

    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      lengthMenu: [10, 20, 50, 100, 200, 500],
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
})

    // Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// Sweetalert
function konfirmasiSimpan()
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin menyimpan data?",
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              form.submit();
          } else {
              Swal.fire("Informasi","Data batal disimpan","error");
          }
      });
  }
  function konfirmasiUbah()
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin mengubah data?",
          showCancelButton: true,
          confirmButtonText: "Ubah",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              form.submit();
          } else {
              Swal.fire("Informasi","Data batal diubah","error");
          }
      });
  }
  function konfirmasiHapus()
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin menghapus data?",
          showCancelButton: true,
          confirmButtonText: "Hapus",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              form.submit();
          } else {
              Swal.fire("Informasi","Data batal dihapus","error");
          }
      });
  }
  
  // END SWEETALERT
</script>
@yield('js')
</body>
</html>