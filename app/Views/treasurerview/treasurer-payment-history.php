<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>
<div class="mb-5 px-5 inspect-sm-table" style="height: 100%;">
    <div class="row px-5">
        <div class="table-responsive-sm mt-4">
            <h5 class="h5 d-none d-md-block d-lg-block mb-4">Payment History</h5>

            <table id="example" class="table table-striped m-auto" style="width:100%;">
                <thead>
                    <tr>
                        <th class="px-2">Schedule Date</th>
                        <th class="px-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paymentusers as $row) : ?>
                        <tr>
                            <td><?php echo date('M d, Y', strtotime($row->schedule_datetime))  ?></td>
                            <td class="d-flex justify-content-center"><a href="<?php echo base_url(); ?>/PaymentHistoryDate/<?= $row->schedule_datetime ?>"><button class="btn-viewdetails-mso btn btn-primary btn-sm text-center"><i class="view-user fa fa-info-circle"></i> View Details</button></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>