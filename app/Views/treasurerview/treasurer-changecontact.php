<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>

<div class="mb-5 px-5 pt-2" style="height: 100%; overflow-x:auto">
  <div class="row header-manage mx-4">
    <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Update Contact Number</h1>
  </div>

  <div class="row">
    <form method="post">

      <div class="col-md-4 m-auto mt-5">

        <label for="" class="LabelUser">Contact Number</label>
        <div class="d-flex">
          <i class="fafa-manage-username fa fa-phone"></i>
          <input type="tel" name="contact" value="<?= set_value('contact') ?>" placeholder="+63" class="username-update form-customize form-control" id="contact">
        </div>
        <?php if (isset($validation)) : ?>
          <p class="fails"><?php echo $validation->showError('contact'); ?></p>
        <?php endif; ?>

        <label for="" class="LabelUser mt-2">Password</label>
        <div class="d-flex">
          <i class="fafa-manage-username fa fa-lock"></i>
          <input type="password" name="password" value="<?= set_value('password') ?>" placeholder="Enter Password" id="password" class="username-update form-customize form-control">
          <span><i onclick="password()" class="fafa-eye fa fa-eye"></i></span>
        </div>

        <?php if (isset($validation)) : ?>
          <p class="fails"><?php echo $validation->showError('password'); ?></p>
        <?php endif; ?>
        <div class="row m-auto">
          <button type="submit" name="update-contact-treasurer" class="btn btn-primary mt-3">Update Contact Number</button>
          <button class="btn btn-secondary" type="button" onclick="document.location='<?php echo base_url(); ?>/ManageProfileTreasurer'">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>

</html>
<?= $this->endSection() ?>