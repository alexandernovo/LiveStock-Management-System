<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row" style="height:100vh !important;padding-bottom: 13px !important; ">
    <div class="col-12" style="padding-bottom: 20px !important;">
      <div class="card-custom card px-4" style="height:100%">
        <div class="row header-manage mx-4">
          <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Update Name</h1>
        </div>
        <div class="row">
          <form method="post">
            <div class="col-md-4 m-auto mt-5">
              <div class="form-group">
                <label for="" class="LabelUser">Firstname</label>
                <input type="text" name="firstname" value="<?= set_value('firstname') ?>" id="firstname" placeholder="Enter Firstname" class="form-customize form-control">
              </div>
              <?php if (isset($validation)) : ?>
                <p class="fails">
                  <?php echo $validation->showError('firstname'); ?>
                </p>
              <?php endif; ?>
              <div class="form-group mt-2">
                <label for="" class="LabelUser">Lastname</label>
                <input type="text" name="lastname" value="<?= set_value('lastname') ?>" id="lastname" placeholder="Enter Lastname" id="myInput1" class="form-customize form-control">
              </div>
              <?php if (isset($validation)) : ?>
                <p class="fails">
                  <?php echo $validation->showError('lastname'); ?>
                </p>
              <?php endif; ?>
              <div class="row m-auto">
                <button type="submit" name="update-name-admin" class="btn btn-primary mt-3">Update Name</button>
                <button class="btn btn-secondary" type="button" onclick="document.location='<?php echo base_url(); ?>/ManageProfile'">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <p class="copyright">© Copyright 2022 Department of Agriculture</p>
</div>
<?= $this->endSection() ?>