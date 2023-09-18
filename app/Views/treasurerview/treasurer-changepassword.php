<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>

<div class="mb-5 px-5 pt-2" style="height: 100%; overflow-x:auto">
  <div class="row header-manage mx-4">
    <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Update Password</h1>
  </div>
  <div class="row">
    <form method="post">
      <div class="col-md-4 m-auto">
        <label for="" class="LabelUser mt-5">Current Password</label>
        <div class="d-flex">
          <input type="password" name="currentpass" value="<?= set_value('currentpass') ?>" placeholder="Current Password" id="currentpass" class="form-customize form-control">
          <span><i onclick="currentpass()" class="fafa-eye fa fa-eye"></i></span>
        </div>
        <?php if (isset($validation)) : ?>
          <p class="fails"><?php echo $validation->showError('currentpass'); ?></p>
        <?php endif; ?>
        <label for="" class="LabelUser mt-3">New Password</label>
        <div class="d-flex">
          <input type="password" name="newpass" value="<?= set_value('newpass') ?>" placeholder="New Password" id="newpass" class="form-customize form-control">
          <span><i onclick="newpass()" class="fafa-eye fa fa-eye"></i></span>
        </div>
        <?php if (isset($validation)) : ?>
          <p class="fails"><?php echo $validation->showError('newpass'); ?></p>
        <?php endif; ?>
        <label for="" class="LabelUser mt-3">Confirm New Password</label>
        <div class="d-flex">
          <input type="password" name="confirmnewpass" value="<?= set_value('confirmnewpass') ?>" placeholder="Confirm New Password" id="confirmnewpass" class="form-customize form-control">
          <span><i onclick="confirmnewpass()" class="fafa-eye fa fa-eye"></i></span>
        </div>
        <?php if (isset($validation)) : ?>
          <p class="fails"><?php echo $validation->showError('confirmnewpass'); ?></p>
        <?php endif; ?>

        <div class="row m-auto">
          <button type="submit" name="update-password-treasurer" class="btn btn-primary mt-3">Update Password</button>
          <button class="btn btn-secondary" type="button" onclick="document.location='<?php echo base_url(); ?>/ManageProfileMSO'">Cancel</button>
        </div>
    </form>
  </div>

  </body>

  </html>
  <?= $this->endSection() ?>