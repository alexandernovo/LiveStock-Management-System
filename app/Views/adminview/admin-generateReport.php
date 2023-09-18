<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width='device-width', initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url(); ?>/assets/img/icontitle.png" type="image/icon type" sizes="32x32">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="<?php echo base_url(); ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <link id="pagestyle" href="<?php echo base_url(); ?>/assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/bootstrap/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/bootstrap/js/sweetalert2.all.min.js"></script>
    <link href="<?php echo base_url(); ?>/assets/css/customcss.css" rel="stylesheet" />
    <title>Generate Report</title>
    <style>
        body {
            background-color: #f0f2f5 !important;
            overflow-y: scroll !important;
            overflow: hidden;
            display: block !important;
        }

        .btn-primary,
        .btn.bg-gradient-primary {
            box-shadow: none;
        }
    </style>
</head>

<body>
    <!-- Date -->
    <?php
    $date = strtotime($month);
    $months = date('F', $date);
    $year = date('Y', $date);
    ?>
    <div class="main">
        <div class="navbar-custom" id='stickynav'>
            <ul>
                <li><a class="disappear-sm"><i class="fa fa-print" onclick="printCertificate()"></i></a></li>
                <li><a class="disappear-sm"><i class="fa fa-download" onclick="CreatePDFfromHTML()"></i></a></li>
                <li><a href="<?php echo base_url(); ?>/admin"><button class="btn btn-primary btn-sm px-4">Back</button></a></li>
            </ul>
        </div>
        <div class="card-generate card m-auto mt-2 mb-5 main-generate" id="pdf-sm">
            <div class="pdf m-auto m-auto mt-0" id="pdf">
                <div id="editor"></div>
                <div class="header text-center py-2">
                    <h4 class="head1">Republic of the Philippines</h4>
                    <h4 class="head1">Provice of Iloilo</h4>
                    <h4 class="head2 mt-3">OFFICE OF THE MUNICIPAL SLAUGHTERHOUSE</h4>
                    <h4 class="head2 mt-3">MONTHLY ACCOMPLISHMENT REPORT</h4>
                    <h4 class="head1">For the month of <u> <?php echo $months . ' ' . $year ?> </u></h4>
                </div>
                <table class="generate m-auto mt-4">
                    <thead>
                        <tr>
                            <th>Animals</th>
                            <th>1<sup>st</sup> week</th>
                            <th>2<sup>nd</sup> week</th>
                            <th>3<sup>rd</sup> week</th>
                            <th>4<sup>th</sup> week</th>
                            <th>5<sup>th</sup> week</th>
                            <th>Total</th>
                            <th>Carcass</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pig</td>
                            <td><?= $week1pig ?></td>
                            <td><?= $week2pig ?></td>
                            <td><?= $week3pig ?></td>
                            <td><?= $week4pig ?></td>
                            <td><?= $week5pig ?></td>
                            <td><?= $pigtotal ?></td>
                            <td><?php
                                foreach ($pigcarca as $pigcarcass) :
                                    if ($pigcarcass->animal_weight == Null) {
                                        echo "";
                                    } else {
                                        echo $pigcarcass->animal_weight . ' ' . 'kg';
                                    }
                                endforeach;
                                ?></td>
                        </tr>
                        <tr>
                            <td>Cow</td>
                            <td><?= $week1cow ?></td>
                            <td><?= $week2cow ?></td>
                            <td><?= $week3cow ?></td>
                            <td><?= $week4cow ?></td>
                            <td><?= $week5cow ?></td>
                            <td><?= $cowtotal ?></td>
                            <td><?php
                                foreach ($cowcarca as $cowcarcass) :
                                    if ($cowcarcass->animal_weight == Null) {
                                        echo "";
                                    } else {
                                        echo $cowcarcass->animal_weight . ' ' . 'kg';
                                    }
                                endforeach;
                                ?></td>
                        </tr>
                        <tr>
                            <td>Carabao</td>
                            <td><?= $week1carabao ?></td>
                            <td><?= $week2carabao ?></td>
                            <td><?= $week3carabao ?></td>
                            <td><?= $week4carabao ?></td>
                            <td><?= $week5carabao ?></td>
                            <td><?= $carabaototal ?></td>
                            <td><?php
                                foreach ($carabaocarca as $carabaocarcass) :
                                    if ($carabaocarcass->animal_weight == Null) {
                                        echo "";
                                    } else {
                                        echo $carabaocarcass->animal_weight . ' ' . 'kg';
                                    }
                                endforeach;
                                ?></td>
                        </tr>
                        <tr>
                            <td>Horse</td>
                            <td><?= $week1horse ?></td>
                            <td><?= $week2horse ?></td>
                            <td><?= $week3horse ?></td>
                            <td><?= $week4horse ?></td>
                            <td><?= $week5horse ?></td>
                            <td><?= $horsetotal ?></td>
                            <td><?php
                                foreach ($horsecarca as $horsecarcass) :
                                    if ($horsecarcass->animal_weight == Null) {
                                        echo "";
                                    } else {
                                        echo $horsecarcass->animal_weight . ' ' . 'kg';
                                    }
                                endforeach;
                                ?></td>
                        </tr>

                        <tr>
                            <td>Others</td>
                            <td><?= $week1others ?></td>
                            <td><?= $week2others ?></td>
                            <td><?= $week3others ?></td>
                            <td><?= $week4others ?></td>
                            <td><?= $week5others ?></td>
                            <td><?= $totalothers ?></td>
                            <td><?php
                                foreach ($otherscarca as $otherscarcass) :
                                    if ($otherscarcass->animal_weight == Null) {
                                        echo "";
                                    } else {
                                        echo $otherscarcass->animal_weight . ' ' . 'kg';
                                    }
                                endforeach;
                                ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="footer mt-5">
                    <div class="footer-in d-flex">
                        <div class="foot1 mt-3">
                            <p>Submitted by:</p>
                            <p>_________________________</p>
                            <p contentEditable="true">LEAH BONATE</p>
                            <p>Livestock Technician</p>
                        </div>
                        <div class="foot2 mt-3">
                            <p>Noted by:</p>
                            <p>___________________________</p>
                            <p contentEditable="true">EUGENIO D. DECASTILLO, JR.</p>
                            <p>Municipal Agricultural Officer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-auto disappear-lg">
            <div class="col-md-8 m-auto mt-5 shadow border rounded mx-1">
                <div class="row m-auto justify-content-center">
                    <h6 class="my-3 text-center">No Preview Available in Mobile</h6>
                    <button class="btn btn-primary">Generate Report is not Available</button>
                </div>
            </div>
        </div>

    </div>
</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/Effects.js"></script>
<script>
    window.onscroll = function() {
        myFunction()
    };
    var navbar = document.getElementById("stickynav");
    var pdf = document.getElementById("pdf");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>

</html>