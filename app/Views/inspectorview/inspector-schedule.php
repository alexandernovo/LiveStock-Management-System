<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>
<style>
  .card-setsched {
    height: 100% !important;
  }
</style>
<div class="card-setsched border-0 pb-5">
  <div class="row schedules-sm px-5 pt-4">
    <h5 class="h5 d-none d-md-block">Schedules</h5>
    <div class="mt-4">
      <table id="example" class="table table-striped m-auto inspecto_sched mt-4" style="width:100%;">
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
              <td class="wide-screen-sched">
                <p class="info-name-sm">
                  <?= $result->firstname . ' ' . $result->lastname ?>
                </p>
                <div class="row m-auto">
                  <button type="button" data-toggle="modal" data-target="#exampleModalLong<?= $result->schedule_id ?>" class="btn btn-outline-secondary shadow-none btn-info-inspector align-self-center"><?=
                                                                                                                                                                                                          $result->firstname . ' ' . $result->lastname ?> <i class="fa fa-caret-down"></i></button>
                </div>
              </td>
              <!-- modal start -->
              <!-- Button trigger modal -->
              <!-- Modal -->
              <div class="modal fade" id="exampleModalLong<?= $result->schedule_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle<?= $result->schedule_id ?>">User Information</h5>
                    </div>
                    <div class="modal-body">
                      <p id="firstname<?= $result->schedule_id ?>">Firstname: <strong>
                          <?= $result->firstname ?>
                        </strong></p>
                      <p id="lastname<?= $result->schedule_id ?>">Lastname: <strong>
                          <?= $result->lastname ?>
                        </strong></p>
                      <p id="username<?= $result->schedule_id ?>">Username: <strong>
                          <?= $result->username ?>
                        </strong></p>
                      <p id="contact<?= $result->schedule_id ?>">Contact: <strong>
                          <?= $result->contact ?>
                        </strong></p>
                      <p id="address<?= $result->schedule_id ?>">Address: <strong>
                          <?= $result->address ?>
                        </strong></p>
                      <p id="date<?= $result->schedule_id ?>">Scheduled Date: <strong>
                          <?php $input = $result->schedule_datetime;
                          $date = strtotime($input);
                          echo date('M d, Y h:i:s a', $date); ?>
                        </strong></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- modal end -->

              <td class="schedule_sm">
                <?= $result->address ?>
              </td>
              <td class="schedule_sm">
                <?= $result->contact ?>
              </td>
              <td class="schedule_sm">
                <?= $result->username ?>
              </td>
              <td>
                <?php
                $input = $result->schedule_datetime;
                $date = strtotime($input);
                echo date('M d, Y h:i:s a', $date);
                ?>
              </td>
              <td class="lign-left-sm"><a href="<?php echo site_url(); ?>/InspectorUpdateSchedule/<?= $result->index_id ?>/<?= $result->MSO_id ?>"><button class="btn-viewdetails-mso btn-sm-schedule btn btn-primary btn-sm"><i class="view-user fa fa-info-circle" style="margin-right:4px;"></i>View Details</button></a></td>
            </tr>

          <?php
          endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>