<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>
<style>
  .card-here {
    height: 100% !important;
  }

  body {
    overflow-y: auto !important;
  }

  nav {
    position: sticky !important;
    top: 0 !important;
    z-index: 999 !important;
  }
</style>
<div class="card-here">
  <div class="row mt-3 pb-1 mx-2">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card border">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Schedules</p>
            <h4 class="mb-0"><?php echo $all_sched_count; ?></h4>
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
            <p class="text-sm mb-0 text-capitalize">Schedules Today</p>
            <h4 class="mb-0"><?php echo $inspector_today_count; ?></h4>
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
            <p class="text-sm mb-0 text-capitalize">Schedules this Week</p>
            <h4 class="mb-0"><?php echo $this_week_count; ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card border">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Schedules Next Week</p>
            <h4 class="mb-0"><?php echo $next_week_count; ?></h4>
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
            Accepted Schedules Today</h6>
        </div>
        <div class="card-body px-3 py-1">
          <table class="table table-dashboard table-striped">
            <thead>
              <tr class="border-top">
                <th>MSO</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($inspector_today)) : ?>
                <tr>
                  <td colspan="3" class="text-center">
                    No schedules for today
                  </td>
                </tr>
              <?php endif; ?>
              <?php foreach ($inspector_today as $row) : ?>
                <tr>
                  <td><?= $row->firstname . ' ' . $row->lastname ?></td>
                  <td><?php echo date('M d, Y h:i:s a', strtotime($row->schedule_datetime)) ?></td>
                  <td><a href="<?php echo base_url(); ?>/InspectorUpdateSchedule/<?= $row->index_id ?>/<?= $row->MSO_id ?>?filter=All" class="btn btn-primary btn-sm px-4 mb-0 text-light text-bold"><i class="fa fa-info-circle"></i> View</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row mx-2 mt-2">
    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="card border">
        <div class="card-header px-3 py-1">
          <h6 class="d-flex align-items-center m-0"><i class="material-icons opacity-10 me-1">event</i>
            Accepted Schedules This Week</h6>
        </div>
        <div class="card-body px-3 py-1">
          <table class="table table-dashboard table-striped">
            <thead>
              <tr class="border-top">
                <th>MSO</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($this_week_schedule)) : ?>
                <tr>
                  <td colspan="3" class="text-center">
                    No schedules for this week
                  </td>
                </tr>
              <?php endif; ?>
              <?php foreach ($this_week_schedule as $row) : ?>
                <tr>
                  <td><?= $row->firstname . ' ' . $row->lastname ?></td>
                  <td><?php echo date('M d, Y h:i:s a', strtotime($row->schedule_datetime)) ?></td>
                  <td class="text-center"><a href="<?php echo base_url(); ?>/InspectorUpdateSchedule/<?= $row->index_id ?>/<?= $row->MSO_id ?>?filter=All" class="btn btn-primary btn-sm px-4 mb-0 text-light text-bold"><i class="fa fa-info-circle"></i> View</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="card border">
        <div class="card-header px-3 py-1">
          <h6 class="d-flex align-items-center m-0"><i class="material-icons opacity-10 me-1">event</i>
            Accepted Schedules Next Week</h6>
        </div>
        <div class="card-body px-3 py-1">
          <table class="table table-dashboard table-striped">
            <thead>
              <tr class="border-top">
                <th>MSO</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($next_week)) : ?>
                <tr>
                  <td colspan="3" class="text-center">
                    No schedules for nextweek
                  </td>
                </tr>
              <?php endif; ?>
              <?php foreach ($next_week as $row) : ?>
                <tr>
                  <td><?= $row->firstname . ' ' . $row->lastname ?></td>
                  <td><?php echo date('M d, Y h:i:s a', strtotime($row->schedule_datetime)) ?></td>
                  <td class="text-center"><a href="<?php echo base_url(); ?>/InspectorUpdateSchedule/<?= $row->index_id ?>/<?= $row->MSO_id ?>?filter=All" class="btn btn-primary btn-sm px-4 mb-0 text-light text-bold"><i class="fa fa-info-circle"></i> View</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?= $this->endSection() ?>