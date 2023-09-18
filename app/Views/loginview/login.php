<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicons -->
  <link rel="icon" href="<?php echo base_url(); ?>/assets/img/icontitle.png" type="image/icon type" sizes="32x32">

  <link href="<?php echo base_url(); ?>/homepage-assets/assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>/homepage-assets/assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/bootstrap/css/login.css" />
  <link rel="stylesheet" href="assets/bootstrap/css/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <title>Login</title>
</head>

<body>
  <header id="header" class="fixed-top py-0" style="background-color: #37517e;">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto">
        <img src="<?php echo base_url(); ?>/homepage-assets/assets/img/LOGO LIVESTOCK.png" class="img-fluid" alt="" />
        <a href="index.html" class="title-login" style="text-decoration: none;">SlaughterHouse Management</a>
      </h1>

      <nav id="navbar" class="navbar">
        <a class="getstarted scrollto" style="text-decoration: none;" href="<?php echo base_url(); ?>/homepage">Home</a>
      </nav>
      <!-- .navbar -->
    </div>
  </header>
  <div class="container-fluid container-sm-now">
    <div class="row m-auto">
      <div class="col-md-9 m-auto">
        <div class="row card border mt-5 m-auto">
          <div class="row m-auto p-0">
            <div class="col-md-6 g-0 m-auto">
              <div class="left-sidelogin">
                <div class="col-md-11 m-auto" data-aos="zoom-in" data-aos-delay="200">
                  <img src="assets/img/DAheader.png" width="600" alt="" class="daheader img-fluid mt-2" />
                </div>

                <div class="col-md-11 m-auto">
                  <img src="assets/img/LOGO LIVESTOCK.png" width="600" alt="" class="daheader img-fluid mt-5 " data-aos="zoom-in" data-aos-delay="200" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="dalogo-logo-sm col-md-11 m-auto">
                <img src="assets/img/DA LOGO.png" width="600" alt="" class="daheader img-fluid mt-3" data-aos="zoom-in" data-aos-delay="200" />
              </div>
              <div class="row mt-4">
                <div class="login-logo-sm col-md-5 m-auto text-center">
                  <img src="assets/img/loginlogo2.png" alt="" class="img-fluid tawo2" id="tawo2" data-aos="zoom-in" data-aos-delay="200" />
                </div>
                <form method="post">
                  <div class="col-md-8 m-auto">
                    <div class="row m-auto" data-aos="zoom-in" data-aos-delay="200">
                      <div class="form-group mt-4 d-flex">
                        <span><i class="fafa-input fa fa-user fa-lg" id="user-con"></i></span>
                        <input type="text" value="<?= set_value('username') ?>" placeholder="Enter your Username" class="form-login form-control" id="username" name="username" />
                      </div>
                      <?php if (isset($validation)) : ?>
                        <p class="login-error"><?php echo $validation->showError('username'); ?></p>
                        <?php if ($validation->hasError('username')) : ?>
                          <script>
                            document.getElementById('username').classList.add('is-invalid');
                          </script>
                        <?php endif; ?>
                      <?php endif; ?>

                    </div>
                    <div class="row m-auto" data-aos="zoom-in" data-aos-delay="200">
                      <div class="form-group mt-3 d-flex">
                        <span><i class="fafa-input fa fa-lock fa-lg" id="pas-con"></i></span>
                        <input id="password" type="password" placeholder="Enter your Password" class="form-login form-control" name="password" />
                        <span><i onclick="password()" class="fafa-eye fa fa-eye"></i></span>
                      </div>
                      <?php if (isset($validation)) : ?>
                        <p class="login-error"><?php echo $validation->showError('password'); ?></p>
                      <?php endif; ?>
                    </div>

                    <div class="login-sm form-group mt-3 m-auto row text-center">
                      <div class="row m-auto">
                        <button type="submit" name="login-btn" class="login-button-page btn btn-primary">
                          <i class="fa fa-sign-in px-1"></i>Login
                        </button>
                        <a href="<?php echo base_url(); ?>/forgotpassword" class="forgot mt-2">Forgot Password?</a>
                      </div>

                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript" src="assets/bootstrap/js/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/bootstrap/js/jquery-3.6.0.min.js"></script>
<!-- Vendor JS Files -->
<script src="<?php echo base_url(); ?>/homepage-assets/assets/vendor/aos/aos.js"></script>
<script src="<?php echo base_url(); ?>/homepage-assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/homepage-assets/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url(); ?>/homepage-assets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/homepage-assets/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/homepage-assets/assets/vendor/waypoints/noframework.waypoints.js"></script>
<!-- Template Main JS File -->
<script src="<?php echo base_url(); ?>/homepage-assets/assets/js/main.js"></script>
<script src="assets/js/Effects.js"></script>
<script>
  var messagefailed = "<?= session()->getFlashdata('failed') ?>";
  var messagesuccess = "<?= session()->getFlashdata('success') ?>";
</script>
<?php if (session()->getFlashdata('failed')) : ?>
  <script>
    failed();
  </script>
<?php endif; ?>

<!-- validation -->
<?php if (isset($validation)) :
  $passwordId = 'myInput1';
  $usernameId = 'username';
  $passwordConId = 'pas-con';
  $usernameConId = 'user-con';
  $errors = array(
    'password' => array($passwordId, $passwordConId),
    'username' => array($usernameId, $usernameConId),
  );
  foreach ($errors as $field => $ids) :
    if ($validation->hasError($field)) : ?>
      <script>
        $('#<?php echo $ids[0]; ?>').addClass('is-invalid');
        $('#<?php echo $ids[1]; ?>').addClass('text-danger');
      </script>
<?php
    endif;
  endforeach;
endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
  <script>
    success();
  </script>
<?php endif; ?>

</html>