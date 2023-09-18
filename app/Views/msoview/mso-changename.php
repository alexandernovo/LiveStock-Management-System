<?= $this->extend('msoview/mso-navbar') ?>
<?= $this->section('content') ?>
<style>
    .card-setsched {
        height: 100% !important;
    }
</style>
<div class="card-setsched border-0">
    <div class="row header-manage mx-4">
        <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Update Name</h1>
    </div>
    <div class="row">
        <form method="post">
            <div class="col-md-4 m-auto mt-5">
                <div class="form-group">
                    <label for="" class="LabelUser">Firstname</label>
                    <input type="text" name="firstname" value="<?= set_value('firstname') ?>" placeholder="Enter Firstname" id="firstname" class="form-customize form-control">
                </div>
                <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('firstname'); ?></p>
                <?php endif; ?>
                <div class="form-group mt-2">
                    <label for="" class="LabelUser">Lastname</label>
                    <input type="text" name="lastname" value="<?= set_value('lastname') ?>" placeholder="Enter Lastname" id="lastname" class="form-customize form-control">
                </div>
                <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('lastname'); ?></p>
                <?php endif; ?>
                <div class="row m-auto">
                    <button type="submit" name="update-name-mso" class="btn btn-primary mt-3">Update Name</button>
                    <button class="btn btn-secondary" type="button" onclick="document.location='<?php echo base_url(); ?>/ManageProfileMSO'">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>

</html>

<?= $this->endSection() ?>