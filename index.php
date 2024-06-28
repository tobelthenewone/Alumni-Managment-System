<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include ('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
  if (!is_numeric($key))
    $_SESSION['system'][$key] = $value;
}
ob_end_flush();
include ('header.php');


?>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/newstyle.css" rel="stylesheet">

  <!-- google fonts from moderna -->
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
    rel="stylesheet">


  <!-- css from moderna -->
  <link href="css/style.css" rel="stylesheet">

  <!-- vendor from moderna -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">



</head>

<style>
  a {
    text-decoration: none;
  }

  header.masthead {
    background: url(assets/img/ambo_pic.jpg);
    background-repeat: no-repeat;
    background-size: cover;
  }

  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /*right: -4.5em;*/
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
  }

  #viewer_modal .modal-dialog {
    width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
  }

  #viewer_modal .modal-content {
    background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #viewer_modal img,
  #viewer_modal video {
    max-height: calc(100%);
    max-width: calc(100%);
  }

  footer {
    background: rgba(0, 0, 0) !important;
  }

  body {
    background-image: url('img/pexels-philippedonn-1169754.jpg');
    height: 400px;
    background-size: cover;
    background-position: center;
  }

  a.jqte_tool_label.unselectable {
    height: auto !important;
    min-width: 4rem !important;
    padding: 5px
  }



  /*
a.jqte_tool_label.unselectable {
    height: 22px !important;
}*/
</style>

<body class="" id="">
  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>AU Alumni Service Platform</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!--<a href="#"><img src="assets/img/ambo_LOGO.png" alt="" class="img-fluid"></a> -->
      </div>
      <nav class="navbar" id="navbar">



        <div>
          <ul>
            <li><a href="index.php?page=home">Home</a>
            </li>
            <li><a href="index.php?page=gallery">Gallery</a></li>
            <?php if (isset($_SESSION['login_id'])): ?>
              <li><a href="index.php?page=alumni_list">Alumni</a></li>
              <li class="nav-item"><a href="index.php?page=careers">Jobs</a>
              </li>
              <li><a href="index.php?page=logged_in_user">Alumni
                  Services</a></li>
            <?php endif; ?>
            <li><a href="index.php?page=about">About</a>
            </li>
            <?php if (!isset($_SESSION['login_id'])): ?>
              <li><a href="index.php?page=login" id="login">Login</a></li>
              <li><a href="http://localhost/alumni/admin" id="admin_login">Admin Login</a></li>
              <li><a href="http://localhost/alumni/staff" id="admin_login">Staff Login</a></li>
            <?php else: ?>
              <li class="dropdown"><a href="#"><span><?php echo $_SESSION['login_name'] ?>
                  </span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="index.php?page=my_account" id="manage_my_account"><i class="fa fa-cog"></i>Manage
                      Account</a></li>
                  <li></i><a class="dropdown" href="admin/ajax.php?action=logout2"><i
                        class="bi bi-chevron-down"></i>Logout</a></li>



                </ul>
              </li>
            <?php endif; ?>
          </ul>
        </div>
    </div>
    </nav>
    </div>
  </header>


  <?php
  $page = isset($_GET['page']) ? $_GET['page'] : "home";
  include $page . '.php';
  ?>


  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit'
            onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-righ t"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
  <footer class=" py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0 text-white">Contact us</h2>
          <hr class="divider my-4 mx-auto" />
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
          <a class="d-block"
            href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
        </div>
      </div>
    </div>
    <br>
    <div class="container text-white">
      <div class="small text-center text-muted"><a href="https://www.ambou.edu.et" target="_blank">Ambo University</a> |
        Copyright © 2024 - <?php echo $_SESSION['system']['name'] ?></div>
    </div>

  </footer>

  <?php include ('footer.php') ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
<script type="text/javascript">
  $('#login').click(function () {
    uni_modal("Login", 'login.php')
  })
</script>
<?php $conn->close() ?>

</html>