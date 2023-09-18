<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row" style="height:100vh !important;padding-bottom: 13px !important; ">
    <div class="col-12" style="padding-bottom: 20px !important;">
      <div class="card-custom card px-4" style="height:100%">
        <div class="row px-3">
          <div class="button-view row">
            <div class="button-container p-0">
              <a href="<?php echo base_url(); ?>/AdminController/registeruser"><button class="btn btn-primary bg-gradient-primary btn-view float-end mt-3">Register User</button></a>
            </div>
          </div>

          <div class="row mt-1"></div>
          <div class="table-responsive-sm">
            <div class="whatuser">
              <label for="userSelect" aria-controls="example" class="LabelUser">Select User:</label>
              <select name="selectUser" id="userSelect" class="slect-user form-select mb-1" onchange="location = this.value;">
                <option class="option-user" value="<?php echo base_url(); ?>/ManageTreasurer">&nbsp;Treasurer</option>
                <option class="option-user" value="<?php echo base_url(); ?>/ManageMSO">&nbsp;MSO</option>
                <option class="option-user" value="<?php echo base_url(); ?>/ManageInspector">&nbsp;Inspector</option>
              </select>
            </div>
            <table id="example" class="table table-striped m-auto" style="width:100%;">
              <thead>

                <tr>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Contact No.</th>
                  <th>Username</th>
                  <th></th>
                  <th></th>
                </tr>

              </thead>
              <tbody>
                <?php foreach ($viewuser as $viewResult) : ?>
                  <tr>
                    <td>
                      <?= $viewResult['firstname'] . ' ' . $viewResult['lastname'] ?>
                    </td>
                    <td>
                      <?= $viewResult['address'] ?>
                    </td>
                    <td>
                      <?= $viewResult['contact'] ?>
                    </td>
                    <td>
                      <?= $viewResult['username'] ?>
                    </td>
                    <td><a href="<?php echo base_url(); ?>/UpdateTreasurer/<?= $viewResult['Treasurer_id'] ?>"><button class="btn-viewdetails-mso btn btn-primary btn-sm"><i class="view-user fa fa-edit" style="margin-right:4px;"></i>Update</button></a></td>
                    <td>
                      <div class="row m-auto">
                        <?php if ($viewResult['status'] == 0) { ?>
                          <a href="<?php echo base_url(); ?>/activateTreasurer/<?= $viewResult['Treasurer_id']; ?>" class="btn-viewdetails-mso btn btn-success btn-sm px-0" style="color: white !important;"><i class="fa fa-power-off"></i> Activate</a>
                        <?php } else { ?>
                          <a href="<?php echo base_url(); ?>/deactivateTreasurer/<?= $viewResult['Treasurer_id']; ?>" class="btn-viewdetails-mso btn btn-danger btn-sm px-0" style="color: white !important;"><i class="fa fa-power-off"></i> Deactivate</a>
                        <?php } ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>

            </table>
          </div>
        </div>
        <p class="copyright">© Copyright 2022 Department of Agriculture</p>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>