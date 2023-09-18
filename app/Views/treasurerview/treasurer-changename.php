<?= $this->extend('treasurerview/treasurer-navbar') ?>
<?= $this->section('content') ?>

<div class="mb-5 px-5 pt-2" style="height: 100%; overflow-x:auto">
    <div class="row header-manage mx-4">
        <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Update Name</h1>
    </div>
    <div class="row">
        <form method="post">
            <div class="col-md-4 m-auto mt-5">
                <div class="form-group">
                    <label for="" class="LabelUser">Firstname</label>
                    <input type="text" name="firstname" value="<?= set_value('firstname') ?>" placeholder="Enter Firstname" class="form-customize form-control" id="firstname">
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
                    <button type="submit" name="update-name-treasurer" class="btn btn-primary mt-3">Update Name</button>
                    <button class="btn btn-secondary" type="button" onclick="document.location='<?php echo base_url(); ?>/ManageProfileTreasurer'">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>

</html>

<?= $this->endSection() ?>