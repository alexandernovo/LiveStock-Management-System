<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>
<div class="mb-5 px-5 inspect-sm-table" style="height: 100%;">
    <div class="row px-5">
        <div class="table-responsive-sm mt-4">

            <div class="d-flex justify-content-between flex-sm-inspector mb-3 align-items-center ">
                <div>
                    <h5 class="h5 d-none d-md-block d-lg-block">Payment History</h5>
                    <h6 class="h6 d-none d-md-block d-lg-block">Schedules From <?php echo date('M d, Y', strtotime($_GET['date_from'])) ?> to <?php echo date('M d, Y', strtotime($_GET['date_to'])) ?></h6>
                </div>
                <div class="d-flex align-items-center flex-sub-sm filter-sm">
                    <div class="form-group me-2">
                        <form method="GET" action="<?php echo base_url(); ?>/PaymentHistoryDate">
                            <label class="m-0">Date: From</label>
                            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="date" onchange="this.form.submit()">
                            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="hidden">
                        </form>
                    </div>
                    <div class="form-group me-2">
                        <form method="GET" action="<?php echo base_url(); ?>/PaymentHistoryDate">
                            <label class="m-0">Date: To</label>
                            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : "" ?>" name="date_to" type="date" onchange="this.form.submit()">
                            <input class="form-control form-control-sm form-customize" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : "" ?>" name="date_from" type="hidden">
                        </form>
                    </div>
                </div>
            </div>
            <table id="example" class="table table-striped m-auto" style="width:100%;">
                <thead>
                    <tr>
                        <th class="px-2">Name</th>
                        <th class="px-2">Username</th>
                        <th class="px-2">Address</th>
                        <th class="px-2">Contact</th>
                        <th class="px-2">Schedule Date</th>
                        <th class="px-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paymentusers as $row) : ?>
                        <tr>
                            <td><?= $row->firstname . ' ' . $row->lastname ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->address ?></td>
                            <td><?= $row->contact ?></td>
                            <td><?php echo date('M d, Y h:i:s a', strtotime($row->schedule_datetime))  ?></td>
                            <td class="d-flex justify-content-center"><a href="<?php echo base_url(); ?>/PaymentHistoryAnimals/<?= $row->index_id ?>/<?= $row->MSO_id ?>?filter=All&date_from=<?php echo date('Y-m-d') ?>&date_to=<?php echo date('Y-m-d', strtotime('+7 days')) ?>""><button class=" btn-viewdetails-mso btn btn-primary btn-sm text-center"><i class="view-user fa fa-info-circle"></i> View Details</button></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>