<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>
<div class="px-5 pt-2" style="height: 100vh; overflow-x:auto">
    <div class="row header-manage mx-4">
        <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Account Settings</h1>
    </div>

    <div class="col-md-4 m-auto border mt-4 p-5 pb-2 shadow rounded">
        <div class="body-head ">
            <h4><i class="fa fa-user px-2"></i>Profile</h4>
        </div>
        <?php foreach ($viewprofile as $viewResult) : ?>
            <label for="" class="LabelUser mt-3">Name</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['firstname'] . ' ' . $viewResult['lastname'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/TreasurerUpdatename"><i class="fafa-eye fa fa-edit"></i></a>
            </div>
            <label for="" class="LabelUser mt-3">Username</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['username'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/TreasurerUpdateusername"><i class="fafa-eye fa fa-edit"></i></a>
            </div>
            <label for="" class="LabelUser mt-3">Contact Number</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['contact'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/TreasurerUpdatecontact"><i class="fafa-eye fa fa-edit"></i></a>
            </div>

            <label for="" class="LabelUser mt-3">Address</label>
            <div class="d-flex">
                <input type="text" value="<?= $viewResult['address'] ?>" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/TreasurerUpdateAddress"><i class="fafa-eye fa fa-edit"></i></a>
            </div>

            <label for="" class="LabelUser mt-3">Password</label>
            <div class="d-flex">
                <input type="text" value="*****************" class="form-customize form-control" readonly><a href="<?php echo base_url(); ?>/TreasurerUpdatepassword"><i class="fafa-eye fa fa-edit"></i></a>
            </div>


        <?php endforeach ?>

        <div class="row mt-5"></div>
        <div class="row mt-2"></div>
        <div class="row mt-1"></div>
    </div>
    <div class="row mt-5"></div>
    <div class="row mt-3"></div>
    <div class="row mt-2"></div>
</div>

<?= $this->endSection() ?>