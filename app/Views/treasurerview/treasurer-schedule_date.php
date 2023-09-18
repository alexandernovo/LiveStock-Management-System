<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>

<div class="mb-5 px-5 inspect-sm-table" style="height: 100%;">
  <div class="row mx-auto schedules-sm p-3">
    <div class="d-flex justify-content-between px-3 flex-sm-inspector mb-3 align-items-center">
      <h5 class="mb-0">Schedules From <?php echo date('M d, Y', strtotime($_GET['date_from'])) ?> to <?php echo date('M d, Y', strtotime($_GET['date_to'])) ?> </h5>
      <div class="d-flex align-items-center flex-sub-sm filter-sm">
        <div class="form-group me-2">
          <form method="GET" action="<?php echo base_url(); ?>/TreasurerPerDate">
            <label class="m-0">Date: From</label>
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="date" onchange="this.form.submit()">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="hidden">
          </form>
        </div>
        <div class="form-group me-2">
          <form method="GET" action="<?php echo base_url(); ?>/TreasurerPerDate">
            <label class="m-0">Date: To</label>
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="date" onchange="this.form.submit()">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="hidden">
          </form>
        </div>
      </div>
    </div>

    <table id="example" class="table table-striped m-auto inspecto_sched" style="width:100%;">
      <thead>
        <tr>
          <th>Name</th>
          <th class="schedule_sm">Address</th>
          <th class="schedule_sm">Contact No.</th>
          <th class="schedule_sm">Username</th>
          <th>Scheduled Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($schedules as $result) : ?>
          <tr>
            <td><?= $result->firstname . ' ' . $result->lastname ?></td>
            <td class="schedule_sm"><?= $result->address ?></td>
            <td class="schedule_sm"><?= $result->contact ?></td>
            <td class="schedule_sm"><?= $result->username ?></td>
            <td> <?php
                  $input = $result->schedule_datetime;
                  $date = strtotime($input);
                  echo date('M d, Y h:i:s a', $date);
                  ?></td>
            <td class="lign-left-sm"><a href="<?php echo site_url(); ?>/TreasurerUpdateSchedule/<?= $result->index_id ?>/<?= $result->MSO_id ?>?filter=All&date_from=<?php echo date('Y-m-d') ?>&date_to=<?php echo date('Y-m-d', strtotime('+7 days')) ?>""><button class=" btn-viewdetails-mso btn-sm-schedule btn btn-primary btn-sm"><i class="view-user fa fa-info-circle" style="margin-right:4px;"></i>View Details</button></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>

    </table>
  </div>
</div>
<?= $this->endSection() ?>