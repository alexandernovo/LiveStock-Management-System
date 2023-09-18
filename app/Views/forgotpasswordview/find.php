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
    <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/homepage-assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/homepage-assets/assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/login.css" />
    <title>Forgot Password</title>
</head>

<body>
    <header id="header" class="fixed-top py-2" style="background-color: #37517e;">
        <div class="container d-flex align-items-center px-4">
            <h1 class="logo me-auto">
                <img src="<?php echo base_url(); ?>/homepage-assets/assets/img/LOGO LIVESTOCK.png" class="img-fluid" alt="" />
                <a href="index.html" class="title-login" style="text-decoration: none;">SlaughterHouse Management</a>
            </h1>

            <nav id="navbar" class="navbar">
                <a class="getstarted scrollto" style="text-decoration: none;" href="<?php echo base_url(); ?>/forgotpassword">Back</a>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <div class="container-fluid container-sm-now ">
        <div class="row m-auto mt-3 ">
            <div class="col-md-5 border m-auto mt-5 shadow rounded px-4" style="background-color:white;">
                <div class="header text-center">
                    <i class="fa fa-key mt-4 key-forgot rounded-circle"></i>
                    <h4 class=" mt-3 text-dark">Is this you? <?php if (isset($Name)) {
                                                                    echo $Name;
                                                                } ?></h4>
                    <p>We've sent verification code to this number <?php if (isset($Contact)) {
                                                                        echo $Contact;
                                                                    }
                                                                    ?></p>
                </div>
                <form method="POST">
                    <div class="form-row m-auto">
                        <label style="font-size: 14px;">Verification Code</label>
                        <input type="hidden" name="username" value="<?php if (isset($username)) {
                                                                        echo $username;
                                                                    } ?>">
                        <input type="hidden" name="code" value="<?php if (isset($Code)) {
                                                                    echo $Code;
                                                                } ?>">
                        <input type="text" name="verification" class="form-control" placeholder="Enter verification code we sent you" />
                        <?php if (isset($validation)) : ?>
                            <p class="login-error" style="margin-left:3px;"><?php echo $validation->showError('username'); ?></p>
                        <?php endif; ?>
                        <?php if (isset($wrongcode)) { ?>
                            <p class="login-error" style="margin-left:3px;"><?php echo $wrongcode; ?></p>
                        <?php } ?>
                    </div>
                    <div class="row m-auto my-3">
                        <button type="submit" name="verify" class="btn btn-primary mb-1">Verify</button>
                        <p>Didn`t receive the code? <a href="<?php echo base_url(); ?>/forgotpassword">Go back and try again</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
<script type="text/javascript" src="assets/bootstrap/js/sweetalert2.min.js"></script>
<!-- Template Main JS File -->
<script src="<?php echo base_url(); ?>/homepage-assets/assets/js/main.js"></script>
<script src="assets/js/Effects.js"></script>
<script>
    var messagefailed = "<?= session()->getFlashdata('failed') ?>";
</script>
<?php if (session()->getFlashdata('failed')) : ?>
    <script>
        failed();
    </script>
<?php endif; ?>

</html>