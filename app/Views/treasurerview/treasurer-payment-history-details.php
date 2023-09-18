<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>
<div class="mb-5 px-5 inspect-sm-table" style="height: 100%;">
    <div class="row px-5">
        <div class="table-responsive-sm mt-4">
            <h5 class="h5 d-none d-md-block d-lg-block mb-4">History</h5>
            <table id="example" class="table table-striped m-auto" style="width:100%;">
                <thead>
                    <tr>
                        <th class="px-2">Name</th>
                        <th class="px-2">Scheduled Date</th>
                        <th class="px-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paymentdetails as $row) : ?>
                        <tr>
                            <td><?= $row->firstname . ' ' . $row->lastname ?></td>
                            <td><?php
                                echo date('M d, Y h:i:s a', strtotime($row->Schedule_datetime));
                                ?></td>
                            <td class="d-flex justify-content-center"><a href="<?php echo base_url(); ?>/PaymentHistoryAnimals/<?= $row->index_id ?>/<?= $row->MSO_id ?>"><button class="btn-viewdetails-mso btn btn-primary btn-sm text-center"><i class="view-user fa fa-info-circle"></i> View Payments</button></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>