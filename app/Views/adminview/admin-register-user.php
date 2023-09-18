<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<style>
  body {
    overflow-y: hidden;
  }

  @media(max-width:573px) {
    body {
      overflow-y: auto !important;
    }
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">

      <div class="card-custom card">

        <div class="button-view row">
          <div class="button-container">
            <a href="<?php echo base_url(); ?>/ManageMSO"><button class="btn btn-primary bg-gradient-primary btn-view float-end m-3">View User</button></a>
          </div>
        </div>
        <div class="row mb-3 mx-5 register-as-sm">
          <div class="col-md-4">
            <div class="whatuser1">
              <form method="post">
                <label for="userSelect" class="LabelUser" aria-controls="example">Register as:</label>
                <select name="selectUser" id="userSelect" class="slect-user form-select">
                  <option class="option-user" value="MSO" <?php echo set_select('selectUser', 'MSO', (!empty($Users) && $Users == "MSO" ? TRUE : FALSE)); ?>>&nbsp;MSO</option>
                  <option class="option-user" value="Treasurer" <?php echo set_select('selectUser', 'Treasurer', (!empty($Users) && $Users == "Treasurer" ? TRUE : FALSE)); ?>>&nbsp;Treasurer</option>
                  <option class="option-user" value="Inspector" <?php echo set_select('selectUser', 'Inspector', (!empty($Users) && $Users == "Inspector" ? TRUE : FALSE)); ?>>&nbsp;Inspector</option>
                </select>
            </div>
          </div>
        </div>
        <div class="register-sm row m-auto mx-5">
          <div class="row mb-1">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="LabelUser">Firstname</label>
                <input type="text" name="firstname" value="<?= set_value('firstname') ?>" placeholder="Firstname" class="form-customize form-control" id="firstname">
                <?php if (isset($validation)) : ?>
                  <p class="fails">
                    <?php echo $validation->showError('firstname'); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="LabelUser">Lastname</label>
                <input type="text" name="lastname" value="<?= set_value('lastname') ?>" placeholder="Lastname" class="form-customize form-control" id="lastname">
                <?php if (isset($validation)) : ?>
                  <p class="fails">
                    <?php echo $validation->showError('lastname'); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row mb-1">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="LabelUser">Address</label>
                <input type="text" name="address" value="<?= set_value('address') ?>" id="address" placeholder="Address" class="form-customize form-control">
                <?php if (isset($validation)) : ?>
                  <p class="fails">
                    <?php echo $validation->showError('address'); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="LabelUser">Contact Number</label>
                <div class="d-flex">
                  <span style="margin-right:-5px; margin-left:2px; margin-top:10px; z-index:1; position:absolute; border-right:1px solid lightgray; padding-right:3px; font-size:14px;">+63</span>
                  <input type="text" name="contact" value="<?= set_value('contact') ?>" id="contact" placeholder="9304881991" class="form-customize form-control" style="text-indent:30px;">
                </div>
                <?php if (isset($validation)) : ?>
                  <p class="fails">
                    <?php echo $validation->showError('contact'); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row mb-1">
            <div class="col-md-4">
              <div class="form-group">
                <label for="" class="LabelUser">Username</label>
                <input type="text" name="username" value="<?= set_value('username') ?>" id="username" placeholder="Username" class="form-customize form-control">
                <?php if (isset($validation)) : ?>
                  <p class="fails">
                    <?php echo $validation->showError('username'); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="" class="LabelUser">Password</label>
                <div class="d-flex">
                  <input type="password" name="password" value="<?= set_value('password') ?>" id="password" placeholder="Password" class="form-customize form-control">
                  <span><i onclick="password()" class="fafa-eye fa fa-eye"></i></span>
                </div>
                <?php if (isset($validation)) : ?>
                  <p class="fails">
                    <?php echo $validation->showError('password'); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="" class="LabelUser">Confirm Password</label>
                <div class="d-flex">
                  <input type="password" name="confirmpassword" value="<?= set_value('confirmpassword') ?>" id="confirmpassword" placeholder="Confirm Password" class="form-customize form-control">
                  <span><i onclick="confirmpassword()" class="fafa-eye fa fa-eye"></i></span>
                </div>
                <?php if (isset($validation)) : ?>
                  <p class="fails">
                    <?php echo $validation->showError('confirmpassword'); ?>
                  </p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="button-cont text-center">
              <button type="submit" name="register-user" class="btn btn-primary btn-sm px-5"><i class="fa fa-user-plus px-1"></i>Register</button>
              </form>
            </div>
          </div>
        </div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <div class="row mt-2"></div>

      </div>
      <p class="copyright">© Copyright 2022 Department of Agriculture</p>
    </div>
  </div>
</div>
<?= $this->endSection() ?>