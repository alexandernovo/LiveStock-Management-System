<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row" style="height:100vh !important;padding-bottom: 13px !important; ">
    <div class="col-12" style="padding-bottom: 20px !important;">
      <div class="card-custom card px-4" style="height:100%">
        <div class="row header-manage mx-4">
          <h1 class="manage-header"><i class="fa fa-cog px-2"></i>DA Staff Account Settings</h1>
        </div>

        <div class="col-md-5 m-auto border mt-5 p-5 pb-2 shadow rounded profile-sm">
          <div class="body-head ">
            <h4><i class="fa fa-user px-2"></i>Profile</h4>
          </div>
          <?php foreach ($viewprofile as $viewResult) : ?>
            <label for="" class="LabelUser mt-3">Name</label>
            <div class="d-flex">
              <input type="text" value="<?= $viewResult['DAStaff_firstname'] . ' ' . $viewResult['DAStaff_lastname'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/UpdateName"><i class="fafa-eye fa fa-edit"></i></a>
            </div>
            <label for="" class="LabelUser mt-3">Username</label>
            <div class="d-flex">
              <input type="text" value="<?= $viewResult['DAStaff_username'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/UpdateUsername"><i class="fafa-eye fa fa-edit"></i></a>
            </div>
            <label for="" class="LabelUser mt-3">Password</label>
            <div class="d-flex">
              <input type="text" value="*****************" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/UpdatePassword"><i class="fafa-eye fa fa-edit"></i></a>
            </div>
          <?php endforeach ?>
          <div class="row mt-4"></div>
          <div class="row mt-5"></div>
        </div>
      </div>
      <p class="copyright">© Copyright 2022 Department of Agriculture</p>
    </div>
  </div>
</div>
<?= $this->endSection() ?>