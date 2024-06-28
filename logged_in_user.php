<?php include 'admin/db_connect.php'; ?>
<style>
  .card-custom {
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card-custom:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    background-color: white;
    font-color: black;
  }

  .card-custom img {
    transition: transform 0.3s;
  }

  .card-custom:hover img {
    transform: scale(1.1);
  }

  /* other bootstrap crap*/

  #portfolio .img-fluid {
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
  }

  .gallery-list {
    cursor: pointer;
    border: unset;
    flex-direction: inherit;
  }

  .gallery-img,
  .gallery-list .card-body {
    width: calc(50%)
  }

  .gallery-img img {
    border-radius: 5px;
    min-height: 50vh;
    max-width: calc(100%);
  }

  span.hightlight {
    background: yellow;
  }

  .carousel,
  .carousel-inner,
  .carousel-item {
    min-height: calc(100%)
  }

  header.masthead,
  header.masthead:before {
    min-height: 50vh !important;
    height: 50vh !important
  }

  .row-items {
    position: relative;
  }

  .card-left {
    left: 0;
  }

  .card-right {
    right: 0;
  }

  .rtl {
    direction: rtl;
  }

  .gallery-text {
    justify-content: center;
    align-items: center;
  }

  .masthead {
    min-height: 23vh !important;
    height: 23vh !important;
  }

  .masthead:before {
    min-height: 23vh !important;
    height: 23vh !important;
  }

  .the-card {
    display: flex !Important;
    flex-direction: column !Important;
    align-items: center;
    background-color: rgba(100, 100, 100, 0.1);
    width: 50%;
  }

  .inside-card {
    background-color: black;
  }

  .inside-card:hover {
    background-color: white;
  }

  .link_card:hover {
    text-decoration: none;
  }

  .the-card {
    width: 600px;
  }

  .inside-card {
    background-color: black;
    color: #007bff;
    /* Bootstrap's primary color (blue) */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }

  .inside-card:hover {
    box-shadow: 0 8px 8px rgba(255, 255, 255);
  }

  .link_card {
    color: inherit;
    text-decoration: none;
  }
</style>
<header class="masthead">
  <div class="container-fluid h-100">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-8 align-self-end mb-4 page-title">
        <h3 style="font-size: 30px;" class="text-white">Alumni Services</h3>
        <hr class="mx-auto divider my-2" />

        <div class="col-md-12 mb-2 justify-content-center">
        </div>
      </div>

    </div>
  </div>
</header>
<!-- -->


<!-- -->
<div data-aos="fade-up" class="row">
  <div class="col-md-6">
    <div class="the-card mx-auto">
      <div class="card-custom card my-4 inside-card text-white mb-4 rounded-lg">
        <a href="index.php?page=Original_Transcript" class="link_card">
          <div class="card-header bg-black d-flex justify-content-between align-items-center ">
            <h3 class="card-title">Request Original Transcript</h3>
            <i class="fa fa-chevron-right text-blue-500"></i>
          </div>
          <div class="card-body text-blue-500">
            <p class="card-text">Applicants who want to send their official transcript to higher learning institution
              can submit their request.</p>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="the-card mx-auto">
      <div class="card-custom card my-4 inside-card text-white mb-4 rounded-lg">
        <a href="index.php?page=original_degree" class="link_card">
          <div class="card-header bg-black d-flex justify-content-between align-items-center ">
            <h3 class="card-title">Request Original Degree</h3>
            <i class="fa fa-chevron-right text-blue-500"></i>
          </div>
          <div class="card-body text-blue-500">
            <p class="card-text">Applicants who want to receive their official degree can submit their request here..
            </p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<div data-aos="fade-down" class="row">
  <div class="col-md-6">
    <div class="the-card mx-auto">
      <div class="card-custom card my-4 inside-card text-white mb-4 rounded-lg">
        <a href="index.php?page=Tempo_request" class="link_card">
          <div class="card-header bg-black d-flex justify-content-between align-items-center ">
            <h3 class="card-title">Request Temporary Degree</h3>
            <i class="fa fa-chevron-right text-blue-500"></i>
          </div>
          <div class="card-body text-blue-500">
            <p class="card-text">Students can Submit a Request to the University for Acquiring a Temporary Certificate.
            </p>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="the-card mx-auto">
      <div class="card-custom card my-4 inside-card text-white mb-4 rounded-lg">
        <a href="index.php?page=track_request" class="link_card">
          <div class="card-header bg-black d-flex justify-content-between align-items-center ">
            <h3 class="card-title">Track Request Progress</h3>
            <i class="fa fa-chevron-right text-blue-500"></i>
          </div>
          <div class="card-body text-blue-500">
            <p class="card-text">Users can use their Identification number to check the status of their alumni Request.
            </p>
          </div>
        </a>
      </div>
    </div>
  </div>

</div>