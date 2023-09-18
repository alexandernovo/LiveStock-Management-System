<?= $this->extend('msoview/mso-navbar') ?>
<?= $this->section('content') ?>
<style>
  .card-setsched {
    height: 100% !important;
  }
</style>
<div class="card-setsched border-0">
  <div class="row header-manage mx-4">
    <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Update Username</h1>
  </div>
  <div class="row">
    <form method="post">
      <div class="col-md-4 m-auto mt-5">
        <div class="d-flex">
          <i class="fafa-manage-username fa fa-user"></i>
          <input type="text" name="username" value="<?= set_value('username') ?>" placeholder="New Username" id="username" class="username-update form-customize form-control">
        </div>
        <?php if (isset($validation)) : ?>
          <p class="fails"><?php echo $validation->showError('username'); ?></p>
        <?php endif; ?>
        <div class="d-flex mt-3">
          <i class="fafa-manage-username fa fa-lock"></i>
          <input type="password" name="password" value="<?= set_value('password') ?>" placeholder="Enter Password" id="password" class="username-update form-customize form-control">
          <span><i onclick="password()" class="fafa-eye fa fa-eye"></i></span>
        </div>
        <?php if (isset($validation)) : ?>
          <p class="fails"><?php echo $validation->showError('password'); ?></p>
        <?php endif; ?>
        <?php if (session()->getFlashdata('wrongpass')) : ?>
          <p class="fails"><?= session()->getFlashdata('wrongpass') ?></p>
        <?php endif; ?>
        <div class="row m-auto">
          <button type="submit" name="update-username-mso" class="btn btn-primary mt-3">Update Username</button>
          <button class="btn btn-secondary" type="button" onclick="document.location='<?php echo base_url(); ?>/ManageProfileMSO'">Cancel</button>
        </div>
      </div>
    </form>
  </div>

</div>

</body>

</html>
<?= $this->endSection() ?>