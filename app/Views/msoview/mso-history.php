<?= $this->extend('msoview/mso-navbar') ?>
<?= $this->section('content') ?>
<style>
  .card-setsched {
    height: 100% !important;
  }
</style>
<div class="card-setsched border-0 px-5 pb-5" style="height: 100%;">
  <div class="row px-4">
    <div class="d-flex justify-content-between px-3 flex-sm-inspector align-items-center">
      <div>
        <h5 class="h5 mb-0">
          <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
        </h5>
        <h6 class="h6">Schedules From <?php echo date('M d, Y', strtotime($_GET['date_from'])) ?> to <?php echo date('M d, Y', strtotime($_GET['date_to'])) ?></h6>

        <h6 class="mb-0"></h6>
      </div>
      <div class="d-flex align-items-center flex-sub-sm filter-sm">
        <div class="form-group me-2">
          <form method="GET" action="<?php echo base_url(); ?>/MSOHistory">
            <label class="m-0">Date: From</label>
            <input type="hidden" value="<?php echo $_GET['filter'] ?>" name="filter">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="date" onchange="this.form.submit()">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="hidden">
          </form>
        </div>
        <div class="form-group me-2">
          <form method="GET" action="<?php echo base_url(); ?>/MSOHistory">
            <label class="m-0">Date: To</label>
            <input type="hidden" value="<?php echo $_GET['filter'] ?>" name="filter">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="date" onchange="this.form.submit()">
            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="hidden">
          </form>
        </div>
        <div class="form-group">
          <label class="m-0">Filter: Status</label>
          <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
            <option value="<?php echo base_url(); ?>/MSOHistory?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
            <option value="<?php echo base_url(); ?>/MSOHistory?filter=Pending&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?>> Pending</option>
            <option value="<?php echo base_url(); ?>/MSOHistory?filter=Accepted&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?>> Accepted</option>
            <option value="<?php echo base_url(); ?>/MSOHistory?filter=Rejected&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?>> Rejected</option>
          </select>
        </div>
      </div>
      <button class="btn btn-sm btn-primary filter-sm-button px-4" data-bs-toggle="modal" data-bs-target="#filter-modal"><i class="fa fa-filter"></i> Filter</button>
      <!--Filter Modal -->
      <div class="modal fade" id="filter-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="get" action="<?php echo base_url(); ?>/MSOHistory">
              <div class="modal-body heys">
                <div class="form-group">
                  <label class="labelUser text-start">Date From</label>
                  <input class="form-control form-customize" value="<?php echo $_GET['date_from'] ?>" type="date" name="date_from">
                </div>
                <div class="form-group">
                  <label class="labelUser text-start">Date To</label>
                  <input class="form-control form-customize" value="<?php echo $_GET['date_to'] ?>" type="date" name="date_to">
                </div>
                <div class="form-group">
                  <label class="labelUser text-start">Date From</label>
                  <select class="form-select form-customize" name="filter">
                    <option <?php echo $_GET['filter'] == "All" ? "selected" : "" ?> value="All">All</option>
                    <option <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?> value="Pending">Pending</option>
                    <option <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?> value="Accepted">Accepted</option>
                    <option <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?> value="Rejected">Rejected</option>
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
  </div>
  <div class="table-responsive-sm mt-4">
    <table id="example" class="table table-striped m-auto" style="width:100%;">
      <thead>
        <tr>
          <th class="px-2 hide-sm">You</th>
          <th class="px-2 hide-sm">Address</th>
          <th class="px-2 hide-sm">Contact No.</th>
          <th class="px-2 hide-sm">Username</th>
          <th class="px-2 hide-sm">Status</th>
          <th class="px-2">Date</th>
          <th class="px-2"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($schedules as $result) : ?>
          <tr>
            <td class="hide-sm"><?= $result->firstname . ' ' . $result->lastname ?></td>
            <td class="hide-sm"><?= $result->address ?></td>
            <td class="hide-sm"><?= $result->contact ?></td>
            <td class="hide-sm"><?= $result->username ?></td>
            <td class="hide-sm"><?php echo $result->schedule_status == 0 ? "Pending" : ($result->schedule_status == 1 ? "Accepted" : ($result->schedule_status == 2 ? "Rejected" : "")) ?></td>
            <td>
              <?php
              $input = $result->schedule_datetime;
              $date = strtotime($input);
              echo date('M d, Y h:i:s a', $date);
              ?>
            </td>
            <td><a href="<?php echo base_url(); ?>/MSOHistoryDetails/<?= $result->index_id ?>?filter=All&date_from=<?php echo date('Y-m-d') ?>&date_to=<?php echo date('Y-m-d', strtotime('+7 days')) ?>"><button class=" btn-viewdetails-mso btn btn-primary btn-sm"><i class="view-user fa fa-info-circle" style="margin-right:4px;"></i>View Details</button></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>

    </table>
  </div>
</div>
</div>
<?= $this->endSection() ?>