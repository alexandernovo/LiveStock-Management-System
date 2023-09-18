<?= $this->extend('adminview/admin-navbar') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row" style="height:100vh !important;padding-bottom: 13px !important; ">
        <div class="col-12" style="padding-bottom: 20px !important;">
            <div class="card-custom card px-4" style="height:100%">
                <div class="row px-5 table-details-sm">
                    <div class="row mt-5">
                        <div class="row mx-auto px-4">
                            <div class="form-group px-0">
                                <a href="<?php echo base_url(); ?>/Transaction?filter=All&date_from=<?php echo $_GET['date_from'] ?>&date_to=<?php echo $_GET['date_to'] ?>" class="btn btn-primary text-light text-bold btn-sm px-4 float-end"> <i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between px-4">
                            <?php foreach ($MSO as $MSOS) : ?>
                                <h4 class="name-mso"><?php echo $MSOS['firstname'] . ' ' . $MSOS['lastname']  ?></h4>
                            <?php endforeach; ?>
                            <div class="d-flex align-items-center flex-sub-sm">
                                <label class="m-0 me-2">Filter:</label>
                                <select class="form-select form-select-sm px-2" onchange="location = this.value;" style="width:100px !important">
                                    <option value="<?php echo base_url(); ?>/TransactionDetails/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=All" <?php echo $_GET['filter'] == "All" ? "selected" : "" ?>> All</option>
                                    <option value="<?php echo base_url(); ?>/TransactionDetails/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=Pending" <?php echo $_GET['filter'] == "Pending" ? "selected" : "" ?>> Pending</option>
                                    <option value="<?php echo base_url(); ?>/TransactionDetails/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=Accepted" <?php echo $_GET['filter'] == "Accepted" ? "selected" : "" ?>> Accepted</option>
                                    <option value="<?php echo base_url(); ?>/TransactionDetails/<?php echo $index_id ?>/<?php echo $MSO_id ?>?filter=Rejected" <?php echo $_GET['filter'] == "Rejected" ? "selected" : "" ?>> Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 mx-2 details-sm">

                        <div class="row mt-2 table-sm-details">
                            <div class="table-responsive-sm">
                                <table id="example" class="table table-striped m-auto" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="px-2">Animal Type</th>
                                            <th class="px-2">Quantity</th>
                                            <th class="px-2">Weight</th>
                                            <th class="px-2">Origin</th>
                                            <th class="px-2">Status</th>
                                            <th class="px-2">Reason</th>
                                            <th class="px-2">Inspected by:</th>
                                            <th class="px-2">Payment</th>
                                            <th class="px-2">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transaction as $result) : ?>
                                            <tr>
                                                <td><?= $result->Animal_type ?></td>
                                                <td><?= $result->Animal_quantity ?></td>
                                                <td><?= $result->Animal_weight ?> kg</td>
                                                <td><?= $result->Animal_origin ?></td>
                                                <td><?= $result->inspect_status ?></td>
                                                <td><?php if ($result->inspect_reason === NULL) {
                                                        echo '';
                                                    } else {
                                                        echo $result->inspect_reason;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($result->Inspector_id)) :
                                                        foreach ($inspector as $inspectors) :
                                                            if ($result->Inspector_id == $inspectors['Inspector_id']) {
                                                                echo $inspectors['firstname'] . ' ' . $inspectors['lastname'];
                                                            }
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </td>
                                                <?php if ($result->inspect_status === 'Accepted') {
                                                    foreach ($payment as $payments) :
                                                        if ($result->inspectstatus_id == $payments['inspectstatus_id']) {
                                                            echo '<td>' . $payments['payment_status'] . '</td>';
                                                            echo '<td>' . $payments['payment_price'] . '</td>';
                                                        }
                                                    endforeach;
                                                } else {
                                                    echo '<td> </td>';
                                                    echo '<td> </td>';
                                                }
                                                ?>

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
                                            <td></td>
                                            <td class="text-bold ">
                                                Total: <?php foreach ($totalpayment as $totals) :
                                                            echo $totals->total . ' php';
                                                        endforeach; ?>
                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?= $this->endSection() ?>