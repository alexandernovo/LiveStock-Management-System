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
    <link rel="stylesheet" href="assets/bootstrap/css/login.css" />
    <title>Forgot Password</title>
    <style></style>
</head>

<body>
    <header id="header" class="fixed-top py-2" style="background-color: #37517e;">
        <div class="container d-flex align-items-center px-4">
            <h1 class="logo me-auto">
                <img src="<?php echo base_url(); ?>/homepage-assets/assets/img/LOGO LIVESTOCK.png" class="img-fluid" alt="" />
                <a href="index.html" class="title-login" style="text-decoration: none;">SlaughterHouse Management</a>
            </h1>

            <nav id="navbar" class="navbar">
                <a class="getstarted scrollto" style="text-decoration: none;" href="<?php echo base_url(); ?>/login">Back</a>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <div class="container-fluid container-sm-now ">
        <div class="row m-auto mt-3">
            <div class="col-md-5 border m-auto mt-5 shadow rounded px-4" style="background-color:white;">
                <div class="header text-center">
                    <i class="fa fa-key mt-4 key-forgot rounded-circle"></i>
                    <h4 class=" mt-2">Forgot Password?</h4>
                    <p class="text-danger pb-0 mb-0"><?php if (isset($admin)) {
                                                            echo $admin;
                                                        } ?></p>
                </div>
                <form method="POST">
                    <div class="form-row m-auto">
                        <p class="text-danger mb-0 text-center"><?php if (isset($failed)) {
                                                                    echo $failed;
                                                                } ?><i class="fa-solid fa-wifi-slash"></i></p>
                        <label style="font-size: 14px;">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter your username" />
                        <?php if (isset($validation)) : ?>
                            <p class="login-error" style="margin-left:3px;"><?php echo $validation->showError('username'); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="row m-auto my-3">
                        <button type="submit" name="finds" class="btn btn-primary mb-1 shadow-none">Find</button>
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