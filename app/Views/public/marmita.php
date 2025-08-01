<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro de Refeição</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <?= $this->include('layouts/components/icons') ?>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="<?php echo base_url('assets/css/material-dashboard.css') ?>" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="mb-4 text-center">Solicitação de Marmita</h2>
                        <p class="mb-0" id="tituloPeriodo"></p>
                        <p class="mb-0" id="dataAtual"></p>
                        <form id="formRefeicao">
                            <?= csrf_field() ?>
                            <div class="input-group input-group-outline my-3">
                                <label for="matricula" class="form-label">Matrícula / CPF</label>
                                <input type="text" class="form-control" id="matricula" name="matricula" required />
                            </div>

                            <div class="input-group input-group-outline my-3 is-focused">
                                <label for="setor_id" class="form-label">Setor</label>
                                <select class="form-control" id="setor_id" name="setor_id" required>
                                    <option value="">Selecione um setor</option>
                                    <?php foreach ($setores as $setor): ?>
                                        <option value="<?= $setor['id'] ?>"><?= esc($setor['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" id="btnSubmit" class="btn btn-primary w-100" disabled>Registrar</button>
                        </form>
                        <div id="alertMsg" class="mt-3"></div>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-2 text-sm mx-auto">
                            Não tem uma conta?
                            <a href="<?php echo base_url('cadastro') ?>" class="text-primary text-gradient font-weight-bold">Inscrição</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Elementos fixos
        const btnSubmit = document.getElementById('btnSubmit');
        const alertMsg = document.getElementById('alertMsg');
        const form = document.getElementById('formRefeicao');
        const tituloPeriodo = document.getElementById('tituloPeriodo');
        const dataAtual = document.getElementById('dataAtual');
        const matriculaInput = document.getElementById('matricula');
        const setorSelect = document.getElementById('setor_id');

        // Config do backend
        const periodos = [{
                nome: "Almoço",
                tipo: "marmita_almoco",
                inicio: '<?= getConfig("hora_inicio_almoco") ?>',
                fim: '<?= getConfig("hora_fim_almoco") ?>'
            },
            {
                nome: "Janta",
                tipo: "marmita_janta",
                inicio: '<?= getConfig("hora_inicio_janta") ?>',
                fim: '<?= getConfig("hora_fim_janta") ?>'
            }
        ];

        function parseTimeToMinutes(timeString) {
            const [h, m] = timeString.split(':').map(Number);
            return h * 60 + m;
        }

        function getPeriodoAtual() {
            const now = new Date();
            const minutos = now.getHours() * 60 + now.getMinutes();
            for (const periodo of periodos) {
                const ini = parseTimeToMinutes(periodo.inicio);
                const fim = parseTimeToMinutes(periodo.fim);
                if (minutos >= ini && minutos <= fim) {
                    return periodo; // retorna objeto com nome e tipo
                }
            }
            return null;
        }


        function atualizarInfo() {
            const periodo = getPeriodoAtual();
            tituloPeriodo.textContent = periodo ? `Período: ${periodo.nome}` : "Fora do horário de registro";
            dataAtual.textContent = `Data: ${new Date().toLocaleDateString('pt-BR')}`;
            btnSubmit.disabled = !periodo;
        }


        function mostrarMensagem(msg, tipo) {
            alertMsg.textContent = msg;
            alertMsg.className = `alert alert-${tipo} text-white`;
            setTimeout(() => {
                alertMsg.textContent = '';
                alertMsg.className = '';
            }, 5000);
        }

        function validarCPF(cpf) {
            cpf = cpf.replace(/\D/g, '');
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
            let soma = 0,
                resto;
            for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;
            soma = 0;
            for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            return resto === parseInt(cpf.substring(10, 11));
        }

        matriculaInput.addEventListener('input', e => {
            e.target.value = e.target.value.replace(/\D/g, '');
        });

        form.addEventListener('submit', e => {
            e.preventDefault();
            alertMsg.textContent = '';

            const periodo = getPeriodoAtual();
            if (!periodo) {
                mostrarMensagem("Fora do horário permitido para registro.", "secondary");
                return;
            }
            const tipo = periodo.tipo; // "marmita_almoco" ou "marmita_janta"

            const matricula = matriculaInput.value.trim();
            const setorId = setorSelect.value;

            if (!setorId) {
                mostrarMensagem("Por favor, selecione um setor.", "danger");
                return;
            }

            if (!matricula) {
                mostrarMensagem("Por favor, insira sua matrícula.", "danger");
                return;
            }

            if (matricula.length === 4 || matricula.length === 5) {
                if (matricula.startsWith('0')) {
                    mostrarMensagem("Matrícula não pode começar com 0.", "danger");
                    return;
                }
            } else if (matricula.length === 11) {
                if (!validarCPF(matricula)) {
                    mostrarMensagem("CPF inválido.", "danger");
                    return;
                }
            } else {
                mostrarMensagem("Digite uma matrícula com 4 ou 5 dígitos ou um CPF com 11 dígitos.", "danger");
                return;
            }

            const csrfField = form.querySelector('input[type=hidden]');
            const csrfName = csrfField.name;
            const csrfValue = csrfField.value;

            btnSubmit.disabled = true;
            btnSubmit.textContent = "Registrando...";

            fetch('<?= site_url('registrar-marmita') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `matricula=${encodeURIComponent(matricula)}&setor_id=${encodeURIComponent(setorId)}&tipo=${encodeURIComponent(tipo)}&${encodeURIComponent(csrfName)}=${encodeURIComponent(csrfValue)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        mostrarMensagem(data.message, "success");
                        form.reset();
                    } else {
                        mostrarMensagem(data.message, "danger");
                    }
                })
                .catch(() => {
                    mostrarMensagem("Erro ao enviar dados.", "danger");
                })
                .finally(() => {
                    atualizarInfo();
                    btnSubmit.disabled = !getPeriodoAtual();
                    btnSubmit.textContent = "Registrar";
                });
        });

        atualizarInfo();
        setInterval(atualizarInfo, 60000);
    </script>

    <script src="<?php echo base_url('assets/js/material-dashboard.min.js') ?>"></script>
</body>

</html>