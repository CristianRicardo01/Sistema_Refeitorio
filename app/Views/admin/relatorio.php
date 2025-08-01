<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Lançamentos
<?= $this->endSection() ?>

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
                                <h6 class="text-white text-capitalize ps-3 mb-0">Lançamentos</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="row mb-4" method="get">
                    <div class="col-md">
                        <div>
                            <label for="data_inicio" class="form-label m-0 p-0">Data Início</label>
                            <div class="input-group input-group-outline">
                                <input type="date" class="form-control" name="data_inicio" id="data_inicio" value="<?= esc($data_inicio) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <div>
                            <label for="data_inicio" class="form-label m-0 p-0">Data Fim</label>
                            <div class="input-group input-group-outline">
                                <input type="date" class="form-control" name="data_fim" id="data_fim" value="<?= esc($data_fim) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
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

                    <div class="col-md">
                        <label for="setor" class="form-label m-0 p-0">Setor</label>
                        <div class="input-group input-group-outline">
                            <select name="setor" id="setor" class="form-control">
                                <option value="">Todos</option>
                                <?php foreach ($setores as $s): ?>
                                    <option value="<?= esc($s) ?>" <?= $setor == $s ? 'selected' : '' ?>><?= esc($s) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md">
                        <label for="matricula" class="form-label m-0 p-0">Matrícula</label>
                        <div class="input-group input-group-outline">
                            <input type="text" class="form-control" name="matricula" id="matricula" value="<?= esc($matricula) ?>">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-end my-0">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                    <div class="col-12">
                        <a href="<?= site_url('/admin/exportar/pdf?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-danger" target="_blank">Gerar PDF</a>
                        <a href="<?= site_url('/admin/exportar/csv?' . $_SERVER['QUERY_STRING']) ?>" class="btn btn-success" target="_blank">Gerar CSV</a>
                        <a href="<?= site_url('/admin/relatorio') ?>" class="btn btn-warning ">Limpar</a>
                    </div>
                </form>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <?php if ($data_inicio || $data_fim || $tipo || $matricula): ?>

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Matrícula | CPF</th>
                                        <th class="text-uppercase text-secondary text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Setor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data</th>
                                        <th class="text-uppercase text-secondary text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Registrado em</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tiposFormatados = [
                                        'cafe_manha' => 'Café da Manhã',
                                        'cafe_madrugada' => 'Café da Madrugada',
                                        'almoço' => 'Almoço',
                                        'janta' => 'Janta',
                                        'marmita_almoco' => 'Marmita Almoço',
                                        'marmita_janta' => 'Marmita Janta'
                                    ]; ?>
                                    <?php if (empty($registros)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Nenhum lançamento encontrado.</td>
                                        </tr>
                                    <?php else: ?>

                                        <?php foreach ($registros as $r): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-xs text-secondary mb-0 ">
                                                                <?= esc($r['nome']) ?> </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ">
                                                        <?= esc($r['matricula']) ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ">
                                                        <?= esc($tiposFormatados[$r['tipo']] ?? $r['tipo']) ?>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ">
                                                        <?= esc($r['setor'] ?? '-') ?>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ">
                                                        <?= date('d/m/Y', strtotime($r['data'])) ?>
                                                    </p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <?= date('H:i', strtotime($r['created_at'])) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <div class="mt-3">
                                <?= $pager->links('default', 'default_full') ?>
                            </div>

                        <?php endif; ?>
                        <?php if (!$data_inicio && !$data_fim && !$tipo && !$matricula): ?>
                            <div class="alert alert-info">
                                Preencha os filtros acima e clique em "Filtrar" para visualizar os lançamentos.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>