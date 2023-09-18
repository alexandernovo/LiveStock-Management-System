<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>

<div class="card-users card border-0 pb-4" style="height:100%">
    <div class="row header-manage mx-4">
        <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Account Settings</h1>
    </div>

    <div class="col-md-4 m-auto border mt-4 p-5 pb-2 shadow rounded profile-sm">
        <!-- Profile Card -->

        <div class="body-head ">
            <h4><i class="fa fa-user px-2"></i>Profile</h4>
        </div>

        <?php foreach ($viewprofile as $viewResult) : ?>
            <label for="" class="LabelUser mt-3">Name</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['firstname'] . ' ' . $viewResult['lastname'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/InspectorUpdatename"><i class="fafa-eye fa fa-edit"></i></a>
            </div>

            <label for="" class="LabelUser mt-3">Username</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['username'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/InspectorUpdateusername"><i class="fafa-eye fa fa-edit"></i></a>
            </div>

            <label for="" class="LabelUser mt-3">Contact Number</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['contact'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/InspectorUpdatecontact"><i class="fafa-eye fa fa-edit"></i></a>
            </div>

            <label for="" class="LabelUser mt-3">Address</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['address'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/InspectorUpdateAddress"><i class="fafa-eye fa fa-edit"></i></a>
            </div>

            <label for="" class="LabelUser mt-3">Password</label>
            <div class="d-flex">
                <input type="text" value="*****************" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/InspectorUpdatepassword"><i class="fafa-eye fa fa-edit"></i></a>
            </div>
        <?php endforeach ?>

        <div class="row mt-3"></div>
        <div class="row mt-3"></div>
        <div class="row mt-1"></div>
    </div>
</div>

<?= $this->endSection() ?>