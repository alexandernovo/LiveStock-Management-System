<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?php echo base_url(); ?>/assets/img/icontitle.png" type="image/icon type" sizes="32x32">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="<?php echo base_url(); ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/datatable.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
  <link id="pagestyle" href="<?php echo base_url(); ?>/assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/sweetalert2.min.css">
  <link href="<?php echo base_url(); ?>/assets/css/customcss.css" rel="stylesheet" />

  <title>Meat Shop Owner</title>
  <style>
    @media(max-width: 573px) {
      .dropdown:not(.dropdown-hover) .dropdown-menu {
        margin-top: 0 !important;
        margin-bottom: 6px !important;
      }
    }
  </style>
</head>

<body class="users-body" style="height:100vh">
  <nav class="custom-navbars navbar navbar-expand-lg mt-1 mx-1 navbar-light rounded border">
    <div class="container-fluid">
      <div class="d-flex">
        <a class="navbar-customizes navbar-brand" href="#">
          <img src="<?php echo base_url(); ?>/assets/img/DAleftlogo.png" width="450" height="90" alt="brand" class="logo-users d-inline-block align-text-top g-0 img-fluid">
        </a>
        <button class="navbar-toggler nav-style text-body p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <div class="navbar-toggler-icon sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </button>
      </div>
      <div class="collapse collapse-customize navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-items nav-item">
            <a class="nav-linkster nav-link" aria-current="page" href="<?php echo base_url(); ?>/mso"><i class="icons-navbar-user fa fa-home"></i>Home</a>
          </li>
          <li class="nav-items nav-item">
            <a class="nav-linkster nav-link" href="<?php echo base_url(); ?>/MSOSetSched"><i class="icons-navbar-user fa fa-calendar"></i>Schedule</a>
          </li>
          <li class="nav-items nav-item">
            <a class="nav-linkster nav-link" href="<?php echo base_url(); ?>/MSOHistory?filter=All&date_from=<?php echo date('Y-m-d') ?>&date_to=<?php echo date('Y-m-d', strtotime('+7 days')) ?>"><i class="icons-navbar-user fa fa-history"></i>History</a>
          </li>
          <li class="nav-items nav-item">
            <div class="dropdown show">
              <a class="logout-mso nav-linkster nav-link dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="icons-navbar-user fa fa-cog"></i>Settings</a>
              <div class="droped dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="drop-me dropdown-item" href="<?php echo base_url(); ?>/ManageProfileMSO"><i class="icons-navbar-user fa fa-cog"></i>Account Settings</a>
                <a class="logout logout-user drop-me dropdown-item" href="<?php echo base_url(); ?>/logout"><i class="icons-navbar-user fa fa-sign-out"></i>Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
  </nav>
  <?= $this->renderSection('content') ?>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/bootstrap/js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/datatables.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/datatables-bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="<?php echo base_url(); ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/bootstrap/js/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/material-dashboard.min.js?v=3.0.4"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="<?php echo base_url(); ?>/assets/js/Effects.js"></script>
  <script>
    var messagefailed = "<?= session()->getFlashdata('failed') ?>";
    var messagesuccess = "<?= session()->getFlashdata('success') ?>";
    var message = "<?= session()->getFlashdata('msg') ?>"
    var title = "<?= session()->get('MSO_firstname') ?>";
  </script>

  <?php if (session()->getFlashdata('msg')) : ?>
    <script>
      msg();
    </script>
  <?php endif; ?>

  <?php if (session()->getFlashdata('success')) : ?>
    <script>
      success();
    </script>
  <?php endif; ?>

  <?php if (session()->getFlashdata('failed')) : ?>
    <script>
      failed();
    </script>
  <?php endif; ?>
  <?php
  if (isset($validation)) :
    $errors = ['firstname', 'lastname', 'contact', 'address', 'Address', 'password', 'confirmpassword', 'username', 'currentpass', 'newpass', 'confirmnewpass', 'contact'];
    foreach ($errors as $field) :
      if ($validation->hasError($field)) : ?>
        <script>
          $('#<?= $field ?>').addClass('is-invalid');
        </script>
      <?php endif; ?>
  <?php endforeach;
  endif;
  ?>

</body>

</html>