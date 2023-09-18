<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>

<div class="mb-5 px-5 inspect-sm-table" style="height: 100%;">
  <div class="row mx-auto schedules-sm p-3">
    <div>
      <h5>Schedules</h5>
    </div>

    <table id="example" class="table table-striped m-auto inspecto_sched" style="width:100%;">
      <thead>
        <tr>

          <th>Scheduled Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($schedules as $result) : ?>
          <tr>

            <td> <?php
                  $input = $result->schedule_datetime;
                  $date = strtotime($input);
                  echo date('M d, Y ', $date);
                  ?></td>
            <td class="lign-left-sm"><a href="<?php echo site_url(); ?>/TreasurerPerDate/<?= $result->schedule_datetime ?>"><button class="btn-viewdetails-mso btn-sm-schedule btn btn-primary btn-sm"><i class="view-user fa fa-info-circle" style="margin-right:4px;"></i>View Details</button></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>

    </table>
  </div>
</div>
<?= $this->endSection() ?>