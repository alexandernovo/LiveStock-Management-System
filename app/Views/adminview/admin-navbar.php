<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Livestock Management System</title>
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
    <style>
        @media(max-width:573px) {
            body {
                overflow-y: auto;
            }

            .space {
                display: none !important;
            }
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-200" style="overflow-y:hidden;">
    <aside id="sidenavs" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav" style="z-index:99999; color:black;"></i>
            <div class="navbar-brand m-0" href="#" target="_blank">
                <img src="https://w7.pngwing.com/pngs/788/424/png-transparent-computer-icons-computer-servers-administrator-miscellaneous-logo-black-thumbnail.png" class="navbar-brand-img h-100 rounded-circle" alt="main_logo" />
                <span class="ms-1 font-weight-bold text-white admin-text">DA STAFF</span>
            </div>
        </div>

        <hr class="horizontal light mt-0 mb-2" />
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav" style="overflow-y:hidden;">
                <li class="nav-item">
                    <a type="button" data-showName="bg-gradient-primary0" id="staff" class="nav-link text-white" href="<?php echo base_url(); ?>/ManageProfile">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">DA Staff Account</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" id="dashboard" data-showName="bg-gradient-primary6" href="<?php echo base_url(); ?>/Dashboard">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" id="home" data-showName="bg-gradient-primary1" href="<?php echo base_url(); ?>/admin">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">home</i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" id="manage" data-showName="bg-gradient-primary2" href="<?php echo base_url(); ?>/ManageMSO">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Manage User</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" id="transaction" data-showName="bg-gradient-primary3" href="<?php echo base_url(); ?>/Transaction?filter=All&date_from=<?php echo date('Y-m-d') ?>&date_to=<?php echo date('Y-m-d', strtotime('+7 days')) ?>">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">View Transaction</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <div class=" text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text ms-1">Generate Report</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidenav-footer position-absolute w-100 bottom-0">
            <div class="mx-3">
                <a class="logout btn bg-gradient-primary mt-4 w-100" href="<?php echo base_url(); ?>/logout" type="button">Logout</a>
            </div>
        </div>
    </aside>

    <main class="main-content position-relative border-radius-lg" style="height:100% !important">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="toast-container" style="position: absolute; bottom: 5%; right: 3%; z-index: 9999; float: right;">
            <div class="toast" id="Toasts">
                <div class="toast-header">
                    <strong class="me-auto"><i class="bi-globe"></i> Hello, world!</strong>
                    <small>just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" style="background-color:black; color: black !important;"></button>
                </div>
                <div class="toast-body">
                    This is a basic toast message.
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 999999999999 !important;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Generate Report</h5>
                        <button type="button shadow-none" class="btn close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo base_url(); ?>/GenerateDetails">
                            <label class="labelUser">Select Date</label>
                            <input class="form-customize form-control" name="date-generate" type="month" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="generate" class="btn btn-primary">Generate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->renderSection('content') ?>
    </main>
    <script>
        var win = navigator.platform.indexOf("Win") > -1;
        if (win && document.querySelector("#sidenav-scrollbar")) {
            var options = {
                damping: "0.5",
            };
            Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
        }
    </script>
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
    <script src="<?php echo base_url(); ?>/assets/js/Effects.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/chartjs.min.js"></script>
    <script>
        var title = "<?= session()->get('Admin_firstname') ?>";
        var message = "<?= session()->getFlashdata('msg') ?>"
    </script>
    <script>
        $(document).ready(function() {
            $("#user_check").change(function() {
                console.log("Hey");
                if ($(this).is(":checked")) {
                    localStorage.setItem("user_check", true);
                } else {
                    localStorage.removeItem("user_check");
                }
            });
            $("#pass_check").change(function() {
                if ($(this).is(":checked")) {
                    localStorage.setItem("pass_check", true);
                } else {
                    localStorage.removeItem("pass_check");
                }
            });

            const userChecked = localStorage.getItem("user_check");
            const passChecked = localStorage.getItem("pass_check");

            if (userChecked === "true") {
                $("#user_check").prop("checked", true);
            }
            if (passChecked === "true") {
                $("#pass_check").prop("checked", true);
            }
        });
    </script>
    <?php if (session()->getFlashdata('msg')) : ?>
        <script>
            msg();
        </script>
    <?php endif; ?>
    <script>
        var messagefailed = "<?= session()->getFlashdata('failed') ?>";
        var messagesuccess = "<?= session()->getFlashdata('success') ?>";
    </script>
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
    <?php if (session()->getFlashdata('Toast')) : ?>
        <div class="toast-container border rounded " style="position: absolute; bottom: 5%; right: 3%; z-index: 9999; float: right;">
            <div class="toast fade show bg-gradient-info" id="Toasts">
                <div class="toast-header bg-transparent ">
                    <small class="me-auto" style="color:white"><i class="fa fa-bell"></i> Notification</small>
                    <small style="color:white">just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" style="background-color:black; color: white !important;"></button>
                </div>
                <div class="toast-body">
                    <small style="color:white"><?php echo session()->getFlashdata('Toast'); ?></small>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php
    if (isset($validation)) :
        $errors = ['firstname', 'lastname', 'contact', 'address', 'password', 'confirmpassword', 'username', 'currentpass', 'newpass', 'confirmnewpass'];
        foreach ($errors as $field) :
            if ($validation->hasError($field)) : ?>
                <script>
                    $('#<?= $field ?>').addClass('is-invalid');
                </script>
            <?php endif; ?>
    <?php endforeach;
    endif;
    ?>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");
        var chartData = <?php if (isset($schedule)) : echo $schedule;
                        endif; ?>;
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Sun", "Mon", "Tue", "Wen", "Thu", "Fri", "Sat"],
                datasets: [{
                    label: "Schedule",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: chartData.counts,
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var scheduleDatas = <?php if (isset($schedule_counts)) : echo $schedule_counts;
                            endif; ?>;
        var labelerist = Object.keys(scheduleDatas);
        var datainspecterist = Object.values(scheduleDatas);

        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: labelerist,
                datasets: [{
                    label: "Schedule",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: datainspecterist,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 13,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 9,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        // Inspect Status
        var scheduleData = <?php if (isset($schedule_count)) : echo $schedule_count;
                            endif; ?>;
        var labels = Object.keys(scheduleData);
        var datainspect = Object.values(scheduleData);
        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    label: "Inspected",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: datainspect,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#f8f9fa',
                            font: {
                                size: 13,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 9,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>

</body>

</html>