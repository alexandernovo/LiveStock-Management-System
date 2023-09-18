<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">

      <div class="card-custom card">
        <div class="row mx-3">
          <div class="Heading-page">
            <h4><i class="fa fa-user mx-2"></i>Update User Treasurer</h4>
          </div>
        </div> <?php $id = $treasurer['Treasurer_id'] ?>
        <form method="post" action="<?php echo base_url(); ?>/UpdateUser/<?= $id ?>">
          <input type="hidden" name="id-user" value="treasurer">
          <div class="update-sm row mx-5 mt-5">
            <div class="row mb-1">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" class="LabelUser">Firstname</label>
                  <input type="text" placeholder="Firstname" name="firstname" value="<?= $treasurer['firstname'] ?>" class="form-customize form-control">
                  <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('firstname'); ?></p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" class="LabelUser">Lastname</label>
                  <input type="text" placeholder="Lastname" name="lastname" value="<?= $treasurer['lastname'] ?>" class="form-customize form-control">
                  <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('lastname'); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="row mb-1">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" class="LabelUser">Address</label>
                  <input type="text" placeholder="Address" name="address" value="<?= $treasurer['address'] ?>" class="form-customize form-control">
                  <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('address'); ?></p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" class="LabelUser">Contact Number</label>
                  <input type="text" placeholder="Contact Number" name="contact" value="<?= $treasurer['contact'] ?>" class="form-customize form-control">
                  <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('contact'); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="row m-auto">
              <div class="form-register col-md-4">
                <input class="form-check-input" type="checkbox" value="1" id="user_check" name="checkusername" style="margin-top:11px;">
                <label class="form-check-label" style="margin-top:13px;">
                  <em>Check to update username</em>
                </label>
              </div>

              <div class="form-register col-md-4">
                <input class="form-check-input" type="checkbox" value="1 " id="pass_check" name="checkpassword" style="margin-top:11px;">
                <label class="form-check-label" style="margin-top:13px;">
                  <em>Check to update password</em>
                </label>
              </div>
            </div>

            <div class="row mb-1">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="LabelUser">Username</label>
                  <input type="text" placeholder="Username" name="username" value="<?= $treasurer['username'] ?>" class="form-customize form-control">
                  <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('username'); ?></p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="LabelUser">Password</label>
                  <div class="d-flex">
                    <input type="password" placeholder="Password" id="password" name="password" class="form-customize form-control">
                    <span><i onclick="password()" class="fafa-eye fa fa-eye"></i></span>
                  </div>
                  <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('password'); ?></p>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="" class="LabelUser">Confirm Password</label>
                  <div class="d-flex">
                    <input type="password" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" class="form-customize form-control">
                    <span><i onclick="confirmpassword()" class="fafa-eye fa fa-eye"></i></span>
                  </div>
                  <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('confirmpassword'); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="row mt-5 space"></div>
            <div class="row mt-5 space"></div>
            <div class="row mt-5 space"></div>
            <div class="row mt-3 space"></div>



            <div class="row mt-5 d-flex justify-content-end button-update-sm">

              <div class="col-md-2 mx-3 ">
                <a href="<?php echo base_url(); ?>/ManageTreasurer"><button type="button" name="update-cancel" class="btn btn-danger btn-sm px-5 mx-3">Cancel</button></a>
              </div>
              <div class="col-md-2 ">
                <button type="submit" name="update-user" class="btn btn-primary btn-sm px-5">Update</button>
              </div>

            </div>

        </form>

      </div>
    </div>
  </div>
  <div class="row mt-5"></div>
  <div class="row mt-5"></div>
  <div class="row mt-5"></div>
  <div class="row mt-2"></div>
  <p class="copyright">© Copyright 2022 Department of Agriculture</p>
</div>
<?= $this->endSection() ?>