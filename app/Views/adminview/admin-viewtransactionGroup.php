<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row mx-auto" style="padding-bottom: 13px !important; overflow:hidden;height:100vh !important;">
    <div class="col-12" style="padding-bottom: 30px !important;">
      <div class="card-custom card px-4" style="height:95vh !important;">
        <div class="row mx-auto mt-2 px-3">
          <div class="row mx-auto header-manage">
            <h1 class="manage-header"><i class="fa fa-cog px-2"></i>View Transaction</h1>
          </div>
          <div class="table-responsive-sm mt-4">
            <table id="example" class="table table-striped m-auto" style="width:100%;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($transaction as $transactions) : ?>
                  <tr>
                    <td><?php echo date('M d, Y', strtotime($transactions->schedule_datetime)); ?></td>
                    <td class="text-center"><a href="<?php echo base_url(); ?>/Transaction/<?= $transactions->schedule_datetime ?>?filter=All"><button class="btn-viewdetails-mso btn btn-primary btn-sm"><i class="view-user fa fa-info-circle"></i> View Details</button></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <p class="copyright">© Copyright 2022 Department of Agriculture</p>
</div>
<?= $this->endSection() ?>