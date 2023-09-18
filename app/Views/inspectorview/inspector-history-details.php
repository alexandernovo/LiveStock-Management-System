<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>
<style>
    .card-setsched {
        height: 100% !important;
    }
</style>
<div class="card-setsched border-0 pb-5 px-5 cars-sm">
    <div class="row px-5 pt-4 card-inspect-sm">
        <div class="px-3 form-group">
            <a href="<?php echo base_url(); ?>/InspectorHistory?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" class="btn btn-primary btn-sm mx-2 float-end px-4 text-light text-bold"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="d-flex justify-content-between px-3 flex-sm-inspector">
            <div>
                <h5 class="h5">
                    MSO: <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                </h5>
                <p style="font-size:14px;">Schedule Date Time:
                    <?php
                    echo date('M d, Y h:i:s a', strtotime($sched_date['schedule_datetime']));
                    ?>
                </p>
            </div>
            <div class="d-flex align-items-center flex-sub-sm">
                <label class="m-0 me-2">Filter:</label>
                <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
                    <option value="<?php echo base_url(); ?>/history_details/<?php echo $MSO_id ?>/<?php echo $index_id ?>?filter=All" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
                    <option value="<?php echo base_url(); ?>/history_details/<?php echo $MSO_id ?>/<?php echo $index_id ?>?filter=Pending" <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?>> Pending</option>
                    <option value="<?php echo base_url(); ?>/history_details/<?php echo $MSO_id ?>/<?php echo $index_id ?>?filter=Accepted" <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?>> Accepted</option>
                    <option value="<?php echo base_url(); ?>/history_details/<?php echo $MSO_id ?>/<?php echo $index_id ?>?filter=Rejected" <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?>> Rejected</option>
                </select>
            </div>
        </div>
        <div class="table-responsive-sm mt-2">
            <table id="example" class="table table-striped m-auto" style="width:100%;">
                <thead>
                    <tr>
                        <th class="px-2">Animals</th>
                        <th class="px-2 hide-sm">Quanity</th>
                        <th class="px-2 hide-sm">Weight</th>
                        <th class="px-2 hide-sm">Origin</th>
                        <th class="px-2">Status</th>
                        <th class="px-2 hide-sm">Inspected by:</th>
                        <th class="px-2 hide-sm">Reason</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $result) : ?>
                        <tr>
                            <td class="wide-screen-sched">
                                <p class="info-name-sm">
                                    <?= $result->animal_type ?>
                                </p>
                                <div class="row m-auto pe-5">
                                    <button type="button" data-toggle="modal" data-target="#details<?= $result->schedule_id ?>" class="btn btn-outline-secondary shadow-none btn-info-inspector align-self-center"><?=
                                                                                                                                                                                                                    $result->animal_type ?> <i class="fa fa-caret-down"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="hide-sm">
                                <?= $result->animal_quantity ?>
                            </td>
                            <td class="hide-sm">
                                <?= $result->animal_weight ?>
                            </td>
                            <td class="hide-sm">
                                <?= $result->animal_origin ?>
                            </td>
                            <td>
                                <?= $result->inspect_status ?>
                            </td>
                            <td class="hide-sm">
                                <?php
                                if ($result->Inspector_id != null) :
                                    foreach ($inspector as $inspectors) :
                                        if ($result->Inspector_id == $inspectors['Inspector_id']) { ?>
                                            <?= $inspectors['firstname'] . ' ' . $inspectors['lastname'] ?>
                                <?php
                                        }
                                    endforeach;
                                endif;
                                ?>
                            </td>
                            <td class="hide-sm">
                                <?= $result->inspect_reason ?>
                            </td>
                        </tr>
                        <div class="modal fade" id="details<?= $result->schedule_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle<?= $result->schedule_id ?>">User
                                            Information</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p id="firstname<?= $result->schedule_id ?>">Animal: <strong>
                                                <?= $result->animal_type ?>
                                            </strong></p>
                                        <p id="lastname<?= $result->schedule_id ?>">Quantity: <strong>
                                                <?= $result->animal_quantity ?>
                                            </strong></p>
                                        <p id="username<?= $result->schedule_id ?>">Weight: <strong>
                                                <?= $result->animal_weight ?>
                                            </strong></p>
                                        <p id="contact<?= $result->schedule_id ?>">Origin: <strong>
                                                <?= $result->animal_origin ?>
                                            </strong></p>
                                        <p id="address<?= $result->schedule_id ?>">Status: <strong>
                                                <?= $result->inspect_status ?>
                                            </strong></p>
                                        <p id="reason<?= $result->schedule_id ?>">Reason: <strong>
                                                <?= $result->inspect_reason ?>
                                            </strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>