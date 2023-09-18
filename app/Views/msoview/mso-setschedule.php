<?= $this->extend('msoview/mso-navbar') ?>
<?= $this->section('content') ?>

<style>
  .card-setsched {
    height: 100% !important;
  }
</style>
<div class="card-setsched border-0 shadow-none card px-5">
  <div class="row header-manage mx-4">
    <h1 class="manage-header"><i class="fa fa-calendar px-2"></i>Set Schedule</h1>
  </div>

  <div class="row row-sched px-5">
    <div class="row mt-3">
      <h4 class="name-mso">
        <?= $firstname . ' ' . $lastname ?>
      </h4>
    </div>
  </div>
  <div class="row px-5 sched-sm-p">
    <form id="setsched" method="post" action="<?php echo base_url(); ?>/MSOController/store">
      <div class="col-md-12">
        <div class="row m-auto mt-2">
          <div class="col-md-3 px-0">
            <label for="labelUser" class="">Schedule date and time:</label>
            <div class="d-flex align-items-center">
              <input type="text" id="flatpickr" class="form-control form-customize" name="datetime" placeholder="yyyy-mm-dd hh:mm" required>
              <i class="fa fa-calendar" style="margin-left:-30px" for="flatpickr"></i>
            </div>
            <p class="fails m-0" style="display: none;" id="alert-message"></p>
          </div>
          <div class="col-md-1 sm-setting-sched">
            <label class="labelUser">Added:</label>
            <input type="text" value="0" class="form-customize form-control px-0" id="no" readonly>
          </div>
        </div>

        <div id="row-cloned" height="30">
          <div class="row-of-form row mt-3" id="row-of-form">
            <div class="col-md-2 selected" style="height: 70px;">
              <label class="labelUser">Animal Type:</label>
              <select name="animaltype[]" id="test" class="test form-customize form-select">
                <option value="Pig" class="option-user">&nbsp; Pig</option>
                <option value="Cow" class="option-user">&nbsp; Cow</option>
                <option value="Carabao" class="option-user">&nbsp; Carabao</option>
                <option value="Horse" class="option-user">&nbsp; Horse</option>
                <option class="editable" name="editable" value="other">&nbsp; Others</option>
              </select>
              <input id="editOption" class="editOption form-customize form-control" placeholder="Type Custom Animal" style="display:none; background-color:white !important; width: 90% !important; position: relative !important; top: -41.7px !important;"></input>
            </div>

            <div class="col-md-1 adjust-sm">
              <label class="labelUser">Quantity:</label>
              <input type="text" name="quantity[]" value="1" id='quantity' class="quantity form-customize form-control" readonly>
            </div>

            <div class="col-md-3">
              <label class="labelUser">Weight:</label>
              <div class="d-flex">
                <input type="number" name="weight[]" id='weight' class="weight form-customize form-control" required><span style="margin-left:-35px; margin-top:10px; font-size:14px;">kg</span>
              </div>
            </div>

            <div class="col-md-4">
              <label class="labelUser">Origin:</label>
              <input type="text" id='origin' name="origin[]" class="origin form-customize form-control" required>
            </div>

            <div class="col-md-2">
              <div class="mt-4">
                <button type="button" class="remove btn btn-danger btn-sm align-self-end mt-3" style="display:none;"><i class="fa fa-trash px-1"></i>Remove</button>
              </div>
            </div>

          </div>
        </div>

        <div class="row mt-3">
          <div class="button-schedule-flex d-flex">
            <button class="btn btn-primary btn-sm" type="button" id="add-animal"><i class="fa fa-plus-circle px-1"></i>Add Animal</button>
            <button class="button-sched btn btn-success btn-sm d-flex mx-2" type="submit" id="buttonset">
              <div class="svg-wrapper-1">
                <div class="svg-wrapper">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
                    </path>
                  </svg>
                </div>
              </div>
              <span>Set Schedule</span>
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  var disabled = <?php echo $dates ?>;
  console.log(disabled);
</script>
<?= $this->endSection() ?>