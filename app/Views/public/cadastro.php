<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->include('layouts/components/icons') ?>
    <title>
        Cadastro Refeitorio
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url('assets/css/material-dashboard.css') ?>" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card col-md-6">
            <div class="container">
                <div class="card card-plain">
                    <div class="card-header">
                        <h4 class="font-weight-bolder text-center">Inscrição</h4>
                        <p class="mb-0 text-center">Digite seu Nome e Matrícula para se registrar</p>
                    </div>
                    <div class="card-body">

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger  text-white" role="alert"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-white" role="alert"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= base_url('/cadastrar') ?>">
                            <?= csrf_field() ?>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control text-uppercase" name="nome" required style="text-transform: uppercase;">
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Matrícula / CPF</label>
                                <input id="input_number"
                                    type="text"
                                    class="form-control"
                                    name="matricula"
                                    oninput="validateNumber(this)"
                                    required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg bg-gradient-dark w-100 mt-4 mb-0">Inscrição</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-2 text-sm mx-auto">
                            Já tem uma conta?
                            <a href="<?= base_url("/") ?>" class="text-primary text-gradient font-weight-bold">Entrar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateNumber(input) {
            input.value = input.value.replace(/\D/g, '');
            let number = parseInt(input.value, 10);
            if (isNaN(number) || number < 0) {
                input.value = '';
            }
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>