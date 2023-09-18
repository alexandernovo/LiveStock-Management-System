<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>

<div class="mb-5 px-5 " style="height: 100%;">
    <!-- body -->
    <div class="row schedules-sm px-3">
        <div class="row m-auto mt-4">
            <div class="form-group">
                <a href="<?php echo base_url(); ?>/TreasurerPerDate?date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" class="btn btn-primary btn-sm float-end px-4 text-light text-bold mb-0"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="">
                    <div class="row mt-2">
                        <h4 class="name-mso ">
                            <?php foreach ($name as $names) : ?>
                                <?php echo $names['firstname'] . ' ' . $names['lastname']; ?>
                            <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <p class="m-0 mb-3">Schedule Datetime: <?php echo date('M d, Y h:i:s a', strtotime($datetime['schedule_datetime'])); ?></p>
                    </div>
                </div>

                <div class="d-flex align-items-center flex-sub-sm">
                    <label class="m-0 me-2">Filter:</label>
                    <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
                        <option value="<?php echo base_url(); ?>/TreasurerUpdateSchedule/<?php echo  $index_id ?>/<?php echo $MSO_id ?>?filter=All" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
                        <option value="<?php echo base_url(); ?>/TreasurerUpdateSchedule/<?php echo   $index_id ?>/<?php echo $MSO_id ?>?filter=Paid" <?php echo $_GET['filter'] == "Paid" ? "selected" : "" ?>> Paid</option>
                        <option value="<?php echo base_url(); ?>/TreasurerUpdateSchedule/<?php echo   $index_id ?>/<?php echo $MSO_id ?>?filter=Not Paid" <?php echo $_GET['filter'] == "Not Paid" ? "selected" : "" ?>> Not Paid</option>
                    </select>
                </div>
            </div>
            <?php if ($schedules == null) { ?>
                <div class="row m-auto text-center mt-5">
                    <p>No Data for the <?php echo $_GET['filter'] ?> Payments</p>
                </div>
            <?php } ?>
            <?php foreach ($schedules as $result) : ?>
                <div class=" row sm-space ">
                    <div class="col-md-2">
                        <label class="labelUser">Animal Type</label>
                        <input type="text" class="form-customize form-control" value="<?= $result->Animal_type ?>" readonly>
                    </div>
                    <div class="col-md-1">
                        <label class="labelUser">Quantity</label>
                        <input type="text" class="form-customize form-control" value="<?= $result->Animal_quantity ?>" readonly>
                    </div>
                    <div class="col-md-1">
                        <label class="labelUser">Weight</label>
                        <input type="text" class="form-customize form-control" value="<?= $result->Animal_weight ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="labelUser">Origin</label>
                        <input type="text" class="form-customize form-control" value="<?= $result->Animal_origin ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="labelUser">Inspected Date</label>
                        <input type="text" id="date" class="form-customize form-control" value="<?php
                                                                                                $input = $result->inspect_datetime;
                                                                                                $date = strtotime($input);
                                                                                                echo date('M d, Y h:i:s a', $date);
                                                                                                ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="labelUser">Payment Status</label>
                        <input type="text" class="form-customize form-control" value="<?= $result->payment_status ?>" readonly>
                    </div>
                    <div class="col-md-2 mt-auto accept-reject accept-sm">
                        <?php if ($result->payment_status != "Paid") { ?>
                            <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentmodal<?= $result->payment_id ?>"><i class="fa fa-check"></i> Mark as Paid</button></td>
                        <?php } else if ($result->payment_status == "Paid") { ?>
                            <p class="mb-2" style="font-size: 15px; font-weight:bold"><i class="fa fa-check"></i> Paid</p>
                        <?php } ?>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="paymentmodal<?= $result->payment_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Price</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="<?php echo site_url(); ?>/MarkASPaid">
                                <div class="modal-body">
                                    <div class="form-row">
                                        <input type="hidden" name="payment_id" value="<?= $result->payment_id ?>" />
                                        <input type="hidden" name="index_id" value="<?= $result->index_id ?>" />
                                        <input type="hidden" name="MSO_id" value="<?= $result->MSO_id ?>" />
                                        <div class="d-flex">
                                            <i class="fa fa-coins align-self-center position-absolute ms-2 border-end border-secondary pe-1"></i>
                                            <input type="number" class="form-customize form-control" name="payment_price" placeholder="Enter the price" style="text-indent: 34px !important;" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end modal -->
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>