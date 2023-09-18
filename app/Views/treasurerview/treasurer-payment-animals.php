<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>
<div class="mb-5 px-5 inspect-sm-table" style="height: 100%;">
    <div class="row px-5">
        <div class="form-group mt-3">
            <a href="<?php echo base_url(); ?>/PaymentHistoryDate?date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" class="btn btn-primary btn-sm float-end px-4 text-light text-bold mb-0"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <p class="m-0 mt-3 text-bold text-dark h5"><?php foreach ($user as $users) :
                                                                echo 'MSO: ' . $users['firstname'] . ' ' . $users['lastname'];
                                                            endforeach ?></p>
                <p class="m-0 mt-3 text-dark" style="font-size: 13px;">Schedule Datetime:
                    <?php echo date('M d, Y h:i:s a', strtotime($datetime['schedule_datetime'])); ?>
                </p>
            </div>
            <div class="d-flex align-items-center flex-sub-sm">
                <label class="m-0 me-2">Filter:</label>
                <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
                    <option value="<?php echo base_url(); ?>/PaymentHistoryAnimals/<?php echo  $index_id ?>/<?php echo $MSO_id ?>?filter=All" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
                    <option value="<?php echo base_url(); ?>/PaymentHistoryAnimals/<?php echo   $index_id ?>/<?php echo $MSO_id ?>?filter=Paid" <?php echo $_GET['filter'] == "Paid" ? "selected" : "" ?>> Paid</option>
                    <option value="<?php echo base_url(); ?>/PaymentHistoryAnimals/<?php echo   $index_id ?>/<?php echo $MSO_id ?>?filter=Not Paid" <?php echo $_GET['filter'] == "Not Paid" ? "selected" : "" ?>> Not Paid</option>
                </select>
            </div>
        </div>


        <div class="table-responsive-sm mt-4">
            <table id="example" class="table table-striped m-auto" style="width:100%;">
                <thead>
                    <tr>
                        <th class="px-2">Animals</th>
                        <th class="px-2">Quantity</th>
                        <th class="px-2">Weight</th>
                        <th class="px-2">Origin</th>
                        <th class="px-2">Animal Status</th>
                        <th class="px-2">Payment Status</th>
                        <th class="px-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paymentanimals as $row) : ?>
                        <tr>
                            <td><?= $row->Animal_type ?></td>
                            <td><?= $row->Animal_quantity ?></td>
                            <td><?= $row->Animal_weight ?></td>
                            <td><?= $row->Animal_origin ?></td>
                            <td><?= $row->inspect_status ?></td>
                            <td><?= $row->payment_status ?></td>
                            <td><?= $row->payment_price . ' ' . 'php' ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-bold">
                            Total: <?php foreach ($totalpayment as $totals) :
                                        echo $totals->total . ' ' . 'php';
                                    endforeach; ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>