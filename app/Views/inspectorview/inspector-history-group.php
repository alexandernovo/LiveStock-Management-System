<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>
<style>
    .card-setsched {
        height: 100% !important;
    }
</style>
<div class="card-setsched border-0 pb-5 px-5 cars-sm">
    <div class="row px-5 pt-4 card-inspect-custom">
        <h5 class="h5 d-none d-md-block d-lg-block mb-4">History</h5>
        <table id="example" class="table table-striped m-auto" style="width:100%;">
            <thead>
                <tr>
                    <th class="px-2">History Date</th>
                    <th class="px-2"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $result) : ?>
                    <tr>
                        <td class="wide-screen-sched">
                            <?php echo date('M d, Y', strtotime($result->Schedule_datetime)) ?>
                        </td>
                        <td><a href="<?php echo base_url(); ?>/InspectorHistory/<?= $result->Schedule_datetime ?>?filter=All">
                                <button class="btn-viewdetails-mso btn-sm-schedule btn btn-primary btn-sm btn-inspect-sm">
                                    <i class="view-user fa fa-info-circle" style="margin-right:4px;"></i>View
                                    Details</button>
                            </a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>
<?= $this->endSection() ?>