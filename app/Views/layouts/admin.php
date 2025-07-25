<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->include('layouts/components/icons') ?>
    <title><?= $this->renderSection('title') ?></title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <?= $this->include('layouts/components/icons') ?>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo base_url('') ?>assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <?= $this->renderSection('css') ?>
</head>

<body class="g-sidenav-show  bg-gray-100">

    <!-- Sidebar -->
    <?= view('layouts/components/sidebar') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Main -->
        <!-- Navbar -->
        <?= view('layouts/components/navbar') ?>

        <!-- Conteúdo -->
        <div class="container-fluid py-2">
            <?= $this->include('layouts/components/_session_messages') ?>
            <?= $this->include('layouts/components/_list_custom_errors') ?>
            <?= $this->renderSection('content') ?>
        </div>

    </main>

    <!--   Core JS Files   -->
    <script src="<?php echo base_url('') ?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Views",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#43A047",
                    data: [50, 45, 22, 28, 50, 60, 76],
                    barThickness: 'flex'
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
                            color: '#e5e5e5'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                            color: "#737373"
                        },
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
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
                datasets: [{
                    label: "Sales",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: "#43A047",
                    pointBorderColor: "transparent",
                    borderColor: "#43A047",
                    backgroundColor: "transparent",
                    fill: true,
                    data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                return fullMonths[context[0].dataIndex];
                            }
                        }
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
                            borderDash: [4, 4],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 12,
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
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 12,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Tasks",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: "#43A047",
                    pointBorderColor: "transparent",
                    borderColor: "#43A047",
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
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
                            borderDash: [4, 4],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#737373',
                            font: {
                                size: 14,
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
                            borderDash: [4, 4]
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo base_url('') ?>assets/js/material-dashboard.js"></script>
    <script>
        // js da pagina de usuarios para tivar e desaticar os usuarios
        document.addEventListener("DOMContentLoaded", function() {
            const actionBtn = document.getElementById("confirm-action-btn");
            const actionText = document.getElementById("modal-action");
            const usernameText = document.getElementById("modal-username");

            document.querySelectorAll(".open-status-modal").forEach(btn => {
                btn.addEventListener("click", function() {
                    const userId = this.dataset.id;
                    const userName = this.dataset.name;
                    const action = this.dataset.action; // "ativar" ou "inativar"

                    actionText.textContent = action;
                    usernameText.textContent = userName;

                    // Atualize o link de confirmação com o ID do usuário
                    const url = `<?= base_url('admin/users/toggleStatus/') ?>${userId}`;
                    actionBtn.href = url;
                });
            });
        });
    </script>


    <script>
        // JS da página de cursos para ativar e desativar os cursos
        document.addEventListener("DOMContentLoaded", function() {
            const actionBtn = document.getElementById("confirm-courses-action-btn");
            const actionText = document.getElementById("modal-action");
            const coursesText = document.getElementById("modal-title"); // Altere para modal-title

            document.querySelectorAll(".open-status-modal").forEach(btn => {
                btn.addEventListener("click", function() {
                    const coursesId = this.dataset.id;
                    const coursestitle = this.dataset.title;
                    const action = this.dataset.action; // "ativar" ou "inativar"

                    actionText.textContent = action;
                    coursesText.textContent = coursestitle;

                    // Atualize o link de confirmação com o ID do usuário
                    const url = `<?= base_url('admin/courses/toggleStatus/') ?>${coursesId}`;
                    actionBtn.href = url;
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileModal = document.getElementById('ModalProfile');
            profileModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-id');
                const userName = button.getAttribute('data-name');

                document.getElementById('modal_user_id').value = userId;
                document.getElementById('modal_user_name').value = userName;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sucesso
            const successFlash = document.getElementById('flash-message');
            if (successFlash) {
                setTimeout(() => {
                    successFlash.style.transition = 'opacity 0.5s ease';
                    successFlash.style.opacity = '0';
                    setTimeout(() => successFlash.remove(), 500);
                }, 5000);
            }

            // Erros
            const errorFlashes = document.querySelectorAll('.flash-error');
            errorFlashes.forEach(error => {
                setTimeout(() => {
                    error.style.transition = 'opacity 0.5s ease';
                    error.style.opacity = '0';
                    setTimeout(() => error.remove(), 500);
                }, 5000);
            });
        });
    </script>

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (!empty($modules)) : ?>
                <?php foreach ($modules as $mod) : ?>
                    var quill<?= $mod['id'] ?> = new Quill("#quill-editor-<?= $mod['id'] ?>", {
                        theme: "snow"
                    });

                    // Ao enviar o formulário, copiar conteúdo do editor para o campo hidden
                    document.querySelector('#modalAddLesson<?= $mod['id'] ?> form').addEventListener('submit', function() {
                        var html = quill<?= $mod['id'] ?>.root.innerHTML;
                        document.querySelector('#content-<?= $mod['id'] ?>').value = html;
                    });
                <?php endforeach; ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>