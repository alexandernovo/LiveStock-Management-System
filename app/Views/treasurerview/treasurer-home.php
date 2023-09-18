<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>
<style>
  .card-here {
    height: 100% !important;
    margin-bottom: 30px;
  }

  body {
    overflow-y: auto !important;
    padding-bottom: 500px !important;
  }

  nav {
    position: sticky !important;
    top: 0 !important;
    z-index: 999 !important;
  }
</style>
<div class="card-here">
  <div class="row mt-3 pb-1 mx-2">
    <div class="col-xl-3 col-sm-6">
      <div class="card border">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Pending Payments</p>
            <h4 class="mb-0"><?php echo $paymentPending; ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card border">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">today</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Payments Last week</p>
            <h4 class="mb-0">
              <?php if (empty($paymentTotalLastWeek)) {
                echo "0";
              } else {
                echo '₱' . $paymentTotalLastWeek;
              } ?>
            </h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card border">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Payments this Week</p>
            <h4 class="mb-0"><?php if (empty($paymentTotalThisWeek)) {
                                echo "0";
                              } else {
                                echo '₱' . $paymentTotalThisWeek;
                              } ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card border">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Payments</p>
            <h4 class="mb-0">₱<?php echo $paymentTotal; ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>
  </div>
  <div class="row mx-2 mt-2">
    <div class="col-md-12 col-lg-12 col-sm-12">
      <div class="card border">
        <div class="card-header px-3 py-1">
          <h6 class="d-flex align-items-center m-0"><i class="material-icons opacity-10 me-1">event</i>
            Pending Payments</h6>
        </div>
        <div class="card-body">
          <table class="table table-dashboard table-striped">
            <thead>
              <tr class="border-top">
                <th>MSO</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($paymentPendingNow as $row) : ?>
                <tr>
                  <td><?= $row->firstname . ' ' . $row->lastname ?></td>
                  <td><?php echo date('M d, Y h:i:s a', strtotime($row->schedule_datetime)); ?></td>
                  <td><a href="<?php echo base_url(); ?>/TreasurerUpdateSchedule/<?= $row->index_id ?>/<?= $row->MSO_id ?>?filter=Not Paid" class="btn btn-primary btn-sm px-4 mb-0 text-light text-bold"><i class="fa fa-info-circle"></i> View</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row mx-2 mt-5 mb-5 pb-5">
    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="card z-index-2 border">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-warning shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="last-week-payment" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">Payment Last Week</h6>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">updated automatically</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="card z-index-2 border">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-danger shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="this-week-payment" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">Payments this Week</h6>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">updated automatically</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <p class="copyright mt-5 pt-2">© Copyright 2022 Department of Agriculture</p> -->
<?= $this->endSection() ?>