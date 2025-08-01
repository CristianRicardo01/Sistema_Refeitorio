<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Painel do Admin<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Adicione CSS específico da página aqui -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="card my-4">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Solicitação</h6>
                            </div>

                        </div>

                    </div>
                </div>
                <form class="row mb-4" method="get">
                    <div class="col-md-3">
                        <div>
                            <label for="data_inicio" class="form-label m-0 p-0">Data Início</label>
                            <div class="input-group input-group-outline">
                                <input type="date" name="data_inicio" id="data_inicio" value="<?= esc($data_inicio) ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <label for="data_inicio" class="form-label m-0 p-0">Data Fim</label>
                            <div class="input-group input-group-outline">
                                <input type="date" name="data_fim" id="data_fim" value="<?= esc($data_fim) ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-static mb-4">
                            <label for="tipo" id="tipo" class="ms-0">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="">Todos</option>
                                <option value="almoço" <?= $tipo == 'almoço' ? 'selected' : '' ?>>Almoço</option>
                                <option value="janta" <?= $tipo == 'janta' ? 'selected' : '' ?>>Janta</option>
                                <option value="cafe_manha" <?= $tipo == 'cafe_manha' ? 'selected' : '' ?>>Café da Manhã</option>
                                <option value="cafe_madrugada" <?= $tipo == 'cafe_madrugada' ? 'selected' : '' ?>>Café da Madrugada</option>
                                <option value="marmita_almoco" <?= $tipo == 'marmita_almoco' ? 'selected' : '' ?>>Marmita Almoço</option>
                                <option value="marmita_janta" <?= $tipo == 'marmita_janta' ? 'selected' : '' ?>>Marmita Janta</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </form>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Matrícula | CPF</th>
                                    <th class="text-uppercase text-secondary text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipo</th>
                                    <th class="text-uppercase text-secondary text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Setor</th>
                                    <th class="text-uppercase text-secondary text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Solicitado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tiposFormatados = [
                                    'cafe_manha' => 'Café da Manhã',
                                    'cafe_madrugada' => 'Café da Madrugada',
                                    'almoço' => 'Almoço',
                                    'janta' => 'Janta',
                                    'marmita_almoco' => 'Marmita Almoço',
                                    'marmita_janta' => 'Marmita Janta'
                                ];
                                ?>
                                <?php if (count($registros) > 0): ?>
                                    <?php foreach ($registros as $registro): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="text-xs text-secondary mb-0 ">
                                                            <?= esc(date('d/m/Y', strtotime($registro['data']))) ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <?= esc($registro['matricula']) ?>
                                                </p>
                                            </td>
                                            <td class="align-middle  text-sm">
                                                <?= esc($registro['nome']) ?>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0 ">
                                                    <?= esc($tiposFormatados[$registro['tipo']] ?? $registro['tipo']) ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <?= esc($registro['setor_nome'] ??'-') ?>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <?= esc(date('h:i', strtotime($registro['created_at']))) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <p class="mb-0 text-sm">Não há registros no momento.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <?= $pager->links() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>