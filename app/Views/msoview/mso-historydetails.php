<?= $this->extend('msoview/mso-navbar') ?>
<?= $this->section('content') ?>
<style>
    th {
        padding: 5px !important;
    }

    .card-setsched {
        height: 100% !important;
    }
</style>
<div class="card-setsched border-0">
    <div class="row px-5 table-details-sm">
        <div class="form-group pe-4 mb-2">
            <a href="<?php echo base_url(); ?>/MSOHistory?filter=All&date_from=<?php echo $_GET['date_from']; ?>&date_to=<?php echo $_GET['date_to']; ?>" class="btn btn-primary btn-sm float-end px-4 text-light text-bold mb-0"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <?php if ($schedules != null) : ?>
            <div class="d-flex justify-content-between px-4 align-items-center">
                <div class="row">
                    <h4 class="name-mso">
                        <?= $firstname . ' ' . $lastname ?>
                    </h4>
                </div>
                <div class="d-flex align-items-center flex-sub-sm">
                    <label class="m-0 me-2">Filter:</label>
                    <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
                        <option value="<?php echo base_url(); ?>/MSOHistoryDetails/<?php echo $index_id; ?>?filter=All" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
                        <option value="<?php echo base_url(); ?>/MSOHistoryDetails/<?php echo $index_id; ?>?filter=Pending" <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?>> Pending</option>
                        <option value="<?php echo base_url(); ?>/MSOHistoryDetails/<?php echo $index_id; ?>?filter=Accepted" <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?>> Accepted</option>
                        <option value="<?php echo base_url(); ?>/MSOHistoryDetails/<?php echo $index_id; ?>?filter=Rejected" <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?>> Rejected</option>
                    </select>
                </div>
            </div>
            <div class="mt-2 mx-2 details-sm">
                <div class="row m-auto mt-2 table-sm-details">
                    <p style="font-size:14px;">Schedule Date Time:
                        <?php
                        echo date('M d, Y h:i:s a', strtotime($scheddate['schedule_datetime']));
                        ?>
                    </p>
                <?php endif; ?>
                <?php if (empty($schedules)) { ?>
                    <div class="row m-auto text-center">
                        <p>There is no schedule history to view, <a href="<?php echo base_url(); ?>/MSOHistory" style="color:blue !important;"> click to see
                                more history</a>
                        </p>
                    </div>
                <?php } ?>
                <?php if (!empty($schedules)) : ?>

                    <div class="table-responsive-sm">
                        <table id="example" class="table table-striped m-auto" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="px-2">Animal Type</th>
                                    <th class="hide-sm-mobile px-2">Quantity</th>
                                    <th class="hide-sm-mobile px-2">Weight</th>
                                    <th class="hide-sm-mobile px-2">Origin</th>
                                    <th>Status</th>
                                    <th class="hide-sm-mobile px-2">Inspected by:</th>
                                    <th class="hide-sm-mobile px-2">Reason</th>
                                    <th class="hide-sm-mobile px-2">Payment</th>
                                    <th class="hide-sm-mobile px-2">Price</th>
                                    <?php if ($count > 0) : ?>
                                        <th class="px-2"></th>
                                        <th class="px-2"></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($schedules as $result) : ?>
                                    <tr>
                                        <td class="">
                                            <p class="m-0 p-sm-large">
                                                <?= $result->Animal_type ?>
                                            </p>
                                            <div class="row m-auto">
                                                <button class="button-sm-large m-0 btn py-1 px-4 shadow-none btn-outline-secondary btn-sm align-self-center" data-bs-toggle="modal" data-bs-target="#history-details<?= $result->schedule_id ?>"><?=
                                                                                                                                                                                                                                                    $result->Animal_type ?> <i class="fa fa-caret-down"></i></button>
                                            </div>
                                        </td>
                                        <!-- Modal History -->
                                        <div class="modal fade" id="history-details<?= $result->schedule_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Details</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="m-0 mb-2">Animal Type: <strong>
                                                                <?= $result->Animal_type ?>
                                                            </strong></p>
                                                        <p class="m-0 mb-2">Animal Quantity: <strong>
                                                                <?= $result->Animal_quantity ?>
                                                            </strong></p>
                                                        <p class="m-0 mb-2">Animal Weight: <strong>
                                                                <?= $result->Animal_weight ?>
                                                            </strong></p>
                                                        <p class="m-0 mb-2">Animal Origin: <strong>
                                                                <?= $result->Animal_origin ?>
                                                            </strong></p>
                                                        <p class="m-0 mb-2">Status: <strong>
                                                                <?= $result->inspect_status ?>
                                                            </strong></p>
                                                        <p class="m-0 mb-2">Inspected by: <strong>
                                                                <?php foreach ($inspector as $inspected) :
                                                                    if ($result->Inspector_id == $inspected['Inspector_id']) :
                                                                        echo $inspected['firstname'] . ' ' . $inspected['lastname'];
                                                                    endif;
                                                                endforeach;
                                                                ?>
                                                            </strong></p>
                                                        <p class="m-0 mb-2">Reason:
                                                            <?php if ($result->inspect_reason === NULL) {
                                                                echo '';
                                                            } else {
                                                                echo $result->inspect_reason;
                                                            }
                                                            ?></strong>
                                                        </p>
                                                        <p class="m-0 mb-2">Payment: <strong>
                                                                <?php if ($result->inspect_status === 'Accepted') {
                                                                    foreach ($payment as $payments) :
                                                                        if ($result->inspectstatus_id == $payments['inspectstatus_id']) {
                                                                            echo $payments['payment_status'];
                                                                        } else {
                                                                            echo " ";
                                                                        }
                                                                    endforeach;
                                                                } else {
                                                                    echo " ";
                                                                }

                                                                ?>
                                                            </strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <td class="hide-sm-mobile">
                                            <?= $result->Animal_quantity ?>
                                        </td>
                                        <td class="hide-sm-mobile">
                                            <?= $result->Animal_weight ?> kg
                                        </td>
                                        <td class="hide-sm-mobile">
                                            <?= $result->Animal_origin ?>
                                        </td>
                                        <td>
                                            <?= $result->inspect_status ?>
                                        </td>
                                        <td class="hide-sm-mobile">
                                            <?php
                                            foreach ($inspector as $inspected) :
                                                if ($result->Inspector_id == $inspected['Inspector_id']) :
                                                    echo $inspected['firstname'] . ' ' . $inspected['lastname'];
                                                endif;
                                            endforeach;
                                            ?>
                                        </td>
                                        <td class="hide-sm-mobile">
                                            <?php if ($result->inspect_reason === NULL) {
                                                echo '';
                                            } else {
                                                echo $result->inspect_reason;
                                            }
                                            ?>
                                        </td>

                                        <?php if ($result->inspect_status === 'Accepted') {
                                            foreach ($payment as $payments) :
                                                if ($result->inspectstatus_id == $payments['inspectstatus_id']) {
                                                    echo " <td class='hide-sm-mobile'>" . $payments['payment_status'] . '</td>';
                                                    echo " <td class='hide-sm-mobile'>" . $payments['payment_price'] . '</td>';
                                                }
                                            endforeach;
                                        } else {
                                            echo "<td class='hide-sm-mobile'></td>";
                                            echo "<td class='hide-sm-mobile'></td>";
                                        }
                                        ?>

                                        <?php if ($count > 0) : ?>
                                            <td>
                                                <?php if ($result->inspect_status === 'Pending') : ?>
                                                    <a class="btn-viewdetails-mso btn btn-primary btn-sm" style="color: white !important;" data-bs-toggle="modal" data-bs-target="#update<?= $result->schedule_id ?>"><i class="fa fa-edit"></i>
                                                        Update</a>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Modal update -->
                                            <div class="modal fade" id="update<?= $result->schedule_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Animal</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo base_url(); ?>/MSOController/udpdateSched">
                                                                <input class="form-customize form-control" type="hidden" value="<?= $result->schedule_id ?>" name="scheduleID">
                                                                <input class="form-customize form-control" type="hidden" value="<?= $result->index_id ?>" name="indexID">
                                                                <div class="form-group selected" style="height:80px;">
                                                                    <label>Animal Type</label>
                                                                    <select class="test form-select" id="test" style="text-indent:5px;" name="animaltype" required>
                                                                        <option value="Pig" <?php echo $result->Animal_type == "Pig" ? "selected" : "" ?> class="option option-user">&nbsp; Pig
                                                                        </option>
                                                                        <option value="Cow" <?php echo $result->Animal_type == "Cow" ? "selected" : "" ?>class="option option-user">&nbsp; Cow
                                                                        </option>
                                                                        <option value="Carabao" <?php echo $result->Animal_type == "Carabao" ? "selected" : "" ?> class="option option-user">&nbsp;
                                                                            Carabao</option>
                                                                        <option value="Horse" <?php echo $result->Animal_type == "Horse" ? "selected" : "" ?> class="option option-user">&nbsp;
                                                                            Horse</option>
                                                                        <option class="editable" name="editable" value="other">
                                                                            &nbsp; Others</option>
                                                                    </select>
                                                                    <input id="editOption" class="editOption form-customize form-control" placeholder="Type Custom Animal" style="display:none; background-color:white !important; width: 93% !important; position: relative !important; top: -42px !important;"></input>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Quantity</label>
                                                                    <input class="form-customize form-control" value="<?= $result->Animal_quantity ?>" disabled style="text-indent:5px !important;" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Weight</label>
                                                                    <input type="number" class="form-customize form-control" name="weight" value="<?= $result->Animal_weight ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Origin</label>
                                                                    <input class="form-customize form-control" name="origin" value="<?= $result->Animal_origin ?>" required>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                                            <button type="submit" class="btn btn-primary" name="updatesched"><i class="fa fa-check"></i> Save changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal update end -->

                                            <td>
                                                <?php if ($result->inspect_status === 'Pending') : ?>
                                                    <a class="remove btn-viewdetails-mso btn btn-danger btn-sm" href="<?php echo base_url(); ?>/MSOController/RemoveSched/<?= $result->schedule_id ?>/<?= $result->index_id ?>" style="color: white !important;"><i class="fa fa-trash"></i> Remove</a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <tfoot>
                                <tr class='hide-sm-mobile'>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-bold">
                                        Total:
                                        <?php foreach ($totalpayment as $totals) :
                                            echo $totals->total . ' ' . 'php';
                                        endforeach; ?>
                                    </td>
                                    <?php if ($count > 0) : ?>
                                        <td></td>
                                        <td></td>
                                    <?php endif ?>
                                </tr>
                            </tfoot>
                            </tbody>

                        </table>
                    </div>
                <?php endif; ?>
                </div>
            </div>
    </div>
</div>

<?= $this->endSection() ?>