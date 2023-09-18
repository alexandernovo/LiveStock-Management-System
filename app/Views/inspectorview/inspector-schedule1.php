<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>
<style>
  .card-setsched {
    height: 100% !important;
  }
</style>
<div class="card-setsched border-0 pb-5">
  <div class="row schedules-sm px-5 pt-4 card-inspect-custom">
    <h5 class="h5 d-none d-md-block">Schedules</h5>
    <div class="mt-4">
      <table id="example" class="table table-striped m-auto inspecto_sched mt-4" style="width:100%;">
        <thead>
          <tr>
            <th>Schedule Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($schedules as $result) : ?>
            <tr>
              <td class="wide-screen-sched">
                <?php
                $input = $result->schedule_datetime;
                $date = strtotime($input);
                echo date('M d, Y', $date);
                ?>
              </td>
              <td class="lign-left-sm text-center"><a href="<?php echo site_url(); ?>/InspectorSchedulesperDate/<?= $result->schedule_datetime ?>?filter=All"><button class="btn-viewdetails-mso btn-sm-schedule btn btn-primary btn-sm"><i class="view-user fa fa-calendar" style="margin-right:4px;"></i>View Schedules</button></a></td>
            </tr>

          <?php
          endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>