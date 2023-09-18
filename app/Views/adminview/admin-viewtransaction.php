<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row" style="padding-bottom: 13px !important; overflow:hidden">
    <div class="col-12" style="padding-bottom: 30px !important;">
      <div class="card-custom card px-4" style="height:95vh !important;">
        <div class="row mx-auto px-3">
          <div class="row mx-auto mt-2 header-manage">
            <h1 class="manage-header"><i class="fa fa-cog px-2"></i>View Transaction on</h1>
          </div>
          <div class="d-flex align-items-center flex-sub-sm justify-content-end pe-4 mt-3">
            <div class="form-group me-2">
              <form method="GET" action="<?php echo base_url(); ?>/Transaction">
                <label class="m-0">Date: From</label>
                <input type="hidden" value="<?php echo $_GET['filter'] ?>" name="filter">
                <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="date" onchange="this.form.submit()">
                <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="hidden">
              </form>
            </div>
            <div class="form-group me-2">
              <form method="GET" action="<?php echo base_url(); ?>/Transaction">
                <label class="m-0">Date: To</label>
                <input type="hidden" value="<?php echo $_GET['filter'] ?>" name="filter">
                <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="date" onchange="this.form.submit()">
                <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="hidden">
              </form>
            </div>
            <div class="form-group">
              <label class="m-0 me-2">Filter: Status</label>
              <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
                <option value="<?php echo base_url(); ?>/Transaction?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
                <option value="<?php echo base_url(); ?>/Transaction?filter=Pending&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?>> Pending</option>
                <option value="<?php echo base_url(); ?>/Transaction?filter=Accepted&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?>> Accepted</option>
                <option value="<?php echo base_url(); ?>/Transaction?filter=Rejected&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?>> Rejected</option>
              </select>
            </div>
          </div>
          <div class="table-responsive-sm mt-4">
            <table id="example" class="table table-striped m-auto" style="width:100%;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Contact No.</th>
                  <th>Username</th>
                  <th>Status</th>
                  <th>Scheduled Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($transaction as $transactions) : ?>
                  <tr>
                    <td><?= $transactions->firstname . ' ' . $transactions->lastname ?></td>
                    <td><?= $transactions->address ?></td>
                    <td><?= $transactions->contact ?></td>
                    <td><?= $transactions->username ?></td>
                    <td><?php echo $transactions->schedule_status == 0 ? "Pending" : ($transactions->schedule_status == 1 ? "Accepted" : ($transactions->schedule_status == 0 ? "Rejected" : "")) ?></td>
                    <td>
                      <?php $input = $transactions->schedule_datetime;
                      $date = strtotime($input);
                      echo date('M d, Y h:i:s a', $date);
                      ?></td>
                    <td><a href="<?php echo base_url(); ?>/TransactionDetails/<?= $transactions->index_id ?>/<?= $transactions->MSO_id ?>?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>"><button class="btn-viewdetails-mso btn btn-primary btn-sm"><i class="view-user fa fa-info-circle"></i> View Details</button></a></td>
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