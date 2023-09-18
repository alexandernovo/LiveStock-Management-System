<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>
<style>
  .card-setsched {
    height: 100% !important;
  }

  td {
    vertical-align: middle;
  }
</style>
<div class="card-setsched border-0 pb-5">
  <div class="row schedules-sm px-5 pt-4">
    <div class="d-flex justify-content-between px-3 flex-sm-inspector align-items-center">
      <h5 class="h5"><?php echo $_GET['filter'] ?> Schedules From <?php echo date('M d, Y', strtotime($_GET['date_from'])) ?> to <?php echo date('M d, Y', strtotime($_GET['date_to'])) ?></h5>
      <div class="d-flex align-items-center flex-sub-sm filter-sm">
        <div class="form-group me-2">
          <form method="GET" action="<?php echo base_url(); ?>/InspectorSchedulesperDate">
            <label class="m-0">Date: From</label>
            <input type="hidden" value="<?php echo $_GET['filter'] ?>" name="filter">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="date" onchange="this.form.submit()">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="hidden">
          </form>
        </div>
        <div class="form-group me-2">
          <form method="GET" action="<?php echo base_url(); ?>/InspectorSchedulesperDate">
            <label class="m-0">Date: To</label>
            <input type="hidden" value="<?php echo $_GET['filter'] ?>" name="filter">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="date" onchange="this.form.submit()">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="hidden">
          </form>
        </div>
        <div class="form-group">
          <label class="m-0 me-2">Filter: Status</label>
          <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
            <option value="<?php echo base_url(); ?>/InspectorSchedulesperDate?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
            <option value="<?php echo base_url(); ?>/InspectorSchedulesperDate?filter=Pending&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?>> Pending</option>
            <option value="<?php echo base_url(); ?>/InspectorSchedulesperDate?filter=Accepted&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?>> Accepted</option>
            <option value="<?php echo base_url(); ?>/InspectorSchedulesperDate?filter=Rejected&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?>> Rejected</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-center">
        <button class="btn btn-sm btn-primary filter-sm-button px-4" data-bs-toggle="modal" data-bs-target="#filter-modal"><i class="fa fa-filter"></i> Filter</button>
      </div>
      <div class="modal fade" id="filter-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="get" action="<?php echo base_url(); ?>/InspectorSchedulesperDate">
              <div class="modal-body">
                <div class="form-group">
                  <label class="labelUser">Date From</label>
                  <input class="form-control form-customize" value="<?php echo $_GET['date_from'] ?>" type="date" name="date_from">
                </div>
                <div class="form-group">
                  <label class="labelUser">Date To</label>
                  <input class="form-control form-customize" value="<?php echo $_GET['date_to'] ?>" type="date" name="date_to">
                </div>
                <div class="form-group">
                  <label class="labelUser">Date From</label>
                  <select class="form-select form-customize" name="filter">
                    <option <?php echo  $_GET['filter'] == "All" ? "selected" : "" ?> value="All">All</option>
                    <option <?php echo  $_GET['filter'] == "Pending" ? "selected" : "" ?> value="Pending">Pending</option>
                    <option <?php echo  $_GET['filter'] == "Accepted" ? "selected" : "" ?> value="Accepted">Accepted</option>
                    <option <?php echo  $_GET['filter'] == "Rejected" ? "selected" : "" ?> value="Rejected">Rejected</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-3">
      <table id="example" class="table table-striped m-auto inspecto_sched mt-4" style="width:100%;">
        <thead>
          <tr>
            <th>Name</th>
            <th class="schedule_sm">Address</th>
            <th class="schedule_sm">Contact No.</th>
            <th class="schedule_sm">Username</th>
            <th class="schedule_sm">Scheduled Date</th>
            <th class="schedule_sm">Status</th>
            <th></th>
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
                      <p id="status<?= $result->schedule_id ?>">Status: <strong>
                          <?php echo $result->schedule_status == 0 ? "Pending" : ($result->schedule_status == 1 ? "Accepted" : ($result->schedule_status == 2 ? "Rejected" : "")); ?>
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
              <td class="schedule_sm">
                <?php
                $input = $result->schedule_datetime;
                $date = strtotime($input);
                echo date('M d, Y h:i:s a', $date);
                ?>
              </td>
              <td class="schedule_sm"><?php echo $result->schedule_status == 0 ? "Pending" : ($result->schedule_status == 1 ? "Accepted" : ($result->schedule_status == 2 ? "Rejected" : "")); ?></td>
              <?php if ($result->schedule_status == 0) : ?>
                <td class="lign-left-sm ">
                  <a href="<?php echo base_url(); ?>/InspectorRejectfirst/<?= $result->schedule_datetime ?>/<?= $result->index_id ?>/<?php echo $_GET['filter'] ?>" class="btn-viewdetails-mso btn btn-danger btn-sm m-0 text-light text-bold"><i class="fa fa-trash"></i> Reject</a>
                </td>
                <td class="lign-left-sm">
                  <a href="<?php echo base_url(); ?>/InspectorAcceptfirst/<?= $result->schedule_datetime ?>/<?= $result->index_id ?>/<?php echo $_GET['filter'] ?>" class=" btn-viewdetails-mso btn btn-primary btn-sm m-0 text-light text-bold"><i class="fa fa-trash"></i> Accept</a>
                </td>
              <?php endif; ?>
              <?php if ($result->schedule_status == 1) : ?>
                <td class="lign-left-sm"></td>
                <td class="lign-left-sm"><a href="<?php echo site_url(); ?>/InspectorUpdateSchedule/<?= $result->index_id ?>/<?= $result->MSO_id ?>?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>"><button class="btn-viewdetails-mso btn-sm-schedule btn btn-primary btn-sm"><i class="view-user fa fa-info-circle" style="margin-right:4px;"></i>View Details</button></a></td>
                </td>
              <?php endif; ?>
              <?php if ($result->schedule_status == 2) : ?>
                <td class="lign-left-sm">
                </td>
                <td></td>
              <?php endif; ?>
            </tr>
          <?php
          endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>