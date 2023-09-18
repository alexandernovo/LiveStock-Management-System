<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>
<style>
    .card-setsched {
        height: 100% !important;
    }
</style>
<div class="card-setsched border-0">
    <!-- body -->
    <div class="row px-5 schedules-sm">
        <div class="row m-auto mt-4">
            <div class="px-3 form-group">
                <a href="<?php echo base_url(); ?>/InspectorSchedulesperDate?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" class="btn btn-primary btn-sm mx-2 float-end px-4 text-light text-bold"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="d-flex justify-content-between px-3 flex-sm-inspector">
                <div>
                    <div class="row mx-auto">
                        <h5>MSO: <?= $MSO['firstname'] . ' ' . $MSO['lastname'] ?></h5>
                    </div>
                    <div class="row mx-auto">
                        <p class="m-0 mb-3">Schedule Datetime: <?php echo date('M d, Y h:i:s a', strtotime($dateTime['schedule_datetime'])); ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-sub-sm">
                    <label class="m-0 me-2">Filter:</label>
                    <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
                        <option value="<?php echo base_url(); ?>/InspectorUpdateSchedule/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=All" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
                        <option value="<?php echo base_url(); ?>/InspectorUpdateSchedule/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=Pending" <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?>> Pending</option>
                        <option value="<?php echo base_url(); ?>/InspectorUpdateSchedule/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=Accepted" <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?>> Accepted</option>
                        <option value="<?php echo base_url(); ?>/InspectorUpdateSchedule/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=Rejected" <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?>> Rejected</option>
                    </select>
                </div>
            </div>

            <?php foreach ($schedules as $result) : ?>
                <div class="row sm-space m-auto">
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
                        <input type="text" class="form-customize form-control" value="<?= $result->Animal_weight ?> kg" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="labelUser">Origin</label>
                        <input type="text" class="form-customize form-control" value="<?= $result->Animal_origin ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="labelUser">Status</label>
                        <input type="text" class="form-customize form-control" value="<?= $result->inspect_status ?>" readonly>
                    </div>
                    <?php if ($result->inspect_status == 'Pending') { ?>
                        <div class="col-md-2 accept-reject mt-auto ">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-close"></i> Reject</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reason for Rejecting</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?php echo site_url(); ?>/RejectSched/<?= $result->index_id ?>/<?= $result->inspectstatus_id ?>/<?= $result->MSO_id ?>">
                                                <textarea rows="4" name="reason" class="form-control" required></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                                Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-auto accept-reject accept-sm">
                            <td><a href="<?php echo site_url(); ?>/AcceptSched/<?= $result->index_id ?>/<?= $result->inspectstatus_id ?>/<?= $result->MSO_id ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Accept</button></a></td>
                        </div>
                        <!-- end button div -->

                    <?php } else if ($result->inspect_status == 'Rejected') { ?>
                        <div class="col-md-2 mt-auto accept-reject accept-sm">
                            <p class="mb-2 text-center" style="font-size: 15px; font-weight:bold"><i class="fa fa-times"></i> Rejected</p>
                        </div>
                    <?php } else if ($result->inspect_status == 'Accepted') { ?>
                        <div class="col-md-2 mt-auto accept-reject accept-sm">
                            <p class="mb-2 text-center" style="font-size: 15px; font-weight:bold"><i class="fa fa-check"></i> Accepted</p>
                        </div>
                    <?php } ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>