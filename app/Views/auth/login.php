<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/Hospital.png')?>">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/Hospital.png')?>">
    <title>
        Refeitório - Login
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="<?php echo base_url('assets/css/nucleo-icons.css')?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/nucleo-svg.css')?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url('assets/css/material-dashboard.css?v=3.2.0')?>" rel="stylesheet" />
</head>

<body class="bg-gray-200">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('../assets/img/photo-1531512073830-ba890ca4eba2.avif');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Login</h4>
                                </div>
                            </div>
                            <div class="card-body">

                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                                    <?php if (session()->getFlashdata('error')): ?>
                                        <p style="color:red">
                                            <?= session()->getFlashdata('error') ?>
                                        </p>
                                    <?php endif; ?>
                                </h4>

                                <form method="post" action="<?= site_url('login') ?>">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" type="text" name="username" required>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control" type="password" name="password" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-12 col-md-6 my-auto">
                            <div class="copyright text-center text-sm text-white text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                All copyrights to <i class="fa fa-heart" aria-hidden="true"></i>
                                <a href="mailto:cristiansilv50@gmail.com" class="font-weight-bold text-white" target="_blank">Cristian Ricardo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="<?php echo base_url('assets/js/core/popper.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/core/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/perfect-scrollbar.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/smooth-scrollbar.min.js')?>"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url('assets/js/material-dashboard.min.js?v=3.2.0')?>"></script>
</body>

</html>