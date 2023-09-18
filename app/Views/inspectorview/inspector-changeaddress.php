<?= $this->extend('inspectorview/inspector-navbar') ?>
<?= $this->section('content') ?>

<div class="card-users card border-0 pb-4" style="height:100vh !important;">
    <div class="row header-manage mx-4">
        <h1 class="manage-header"><i class="fa fa-cog px-2"></i>Update Address</h1>
    </div>
    <div class="row">
        <form method="post">
            <div class="col-md-4 m-auto mt-5">
                <div class="form-group">
                    <label for="" class="LabelUser">Address</label>
                    <input type="text" name="Address" value="<?= set_value('Address') ?>" placeholder="Enter Address" class="form-customize form-control" id="Address">
                </div>
                <?php if (isset($validation)) : ?>
                    <p class="fails"><?php echo $validation->showError('Address'); ?></p>
                <?php endif; ?>
                <div class="row m-auto">
                    <button type="submit" name="update-address-inspector" class="btn btn-primary mt-3">Update Address</button>
                    <button class="btn btn-secondary" type="button" onclick="document.location='<?php echo base_url(); ?>/ManageProfileInspector'">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div></div>
</body>

</html>

<?= $this->endSection() ?>