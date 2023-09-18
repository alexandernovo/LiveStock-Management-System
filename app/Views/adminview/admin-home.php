<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<style>
  body {
    overflow-x: hidden;
  }
  .card {
    height: 100% !important;
  }
</style>
<div class="row" style="height:100% !important; ">
  <div class="col-12">
    <div class="container-fluid" style="height:100%; padding-bottom: 33px !important;">
      <div class="card-custom card px-4" style="height:95.6vh !important">
        <div class="row m-2 mt-3">
          <a class="logo navbar-brand">
            <img src="<?php echo base_url(); ?>/assets/img/DAleftlogo.png" alt="" width="650" class="logo img-fluid" />
          </a>
        </div>


        <div class="row m-auto mt-2 mx-3">
          <div class="col-md-8">
            <h2 class="title">LIVESTOCK SLAUGHTERHOUSE</h2>
            <h2 class="title1">MANAGEMENT SYSTEM</h2>

            <p class="home-definition mt-3">
              A slaughterhouse, also called abattoir, is a facility where
              animals are slaughtered to
              provide foods for humans. Slaughterhouses provide an
              opportunity for inspection and evaluation of fitness
              for human consumption as it allows checking the live animals
              on
              arrival (antemortem inspection) as well as the carcases and
              other parts such as organs
              of slaughtered animals(postmortem inspection).
            </p>
          </div>
          <div class="col-md-4 order-md-last order-first">
            <img src="<?php echo base_url(); ?>/assets/img/LOGO LIVESTOCK.png" alt="" height="900" class="img-fluid">
          </div>

        </div>
        <div class="row mx-3 mt-3">
          <div class="button-con">
            <a href="<?php echo base_url(); ?>/ManageMSO"><button class="get-started btn btn-primary">Get
                Started</button></a>
          </div>
        </div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <div class="row mt-4"></div>
        <div class="row mt-2"></div>

      </div>
      <p class="copyright">© Copyright 2022 Department of Agriculture</p>
    </div>
  </div>
</div>

<?= $this->endSection() ?>