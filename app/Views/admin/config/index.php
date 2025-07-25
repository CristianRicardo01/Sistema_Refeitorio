<?= $this->extend('Layouts/admin') ?>

<?= $this->section('title') ?>Configuração de Horários<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?= base_url('assets/img/photo-1531512073830-ba890ca4eba2.avif') ?>');">
        <span class="mask bg-gradient-dark opacity-6"></span>
    </div>

    <div class="card card-body mx-2 mx-md-4 mt-n6">
        <div class="row">
            <?php
            $legenda = [
                'hora_inicio_almoco'    => 'INICIO ALMOÇO',
                'hora_fim_almoco'       => 'FIM ALMOÇO',
                'hora_inicio_janta'     => 'INICIO JANTA',
                'hora_fim_janta'        => 'FIM JANTA',
                'hora_inicio_cafe'      => 'INICIO CAFÉ DA MANHÃ',
                'hora_fim_cafe'         => 'FIM CAFÉ DA MANHÃ',
                'hora_inicio_madrugada' => 'INICIO CAFÉ DA MADRUGADA',
                'hora_fim_madrugada'    => 'FIM CAFÉ DA MADRUGADA',
            ];
            ?>
            <?php foreach ($configs as $config): ?>
                <div class="col-12 col-xl-4 mb-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><?= esc($legenda[$config['chave']] ?? $config['chave']) ?></h6>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#ModalEdit<?= $config['id'] ?>">
                                <i class="material-symbols-rounded text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                    edit
                                </i>
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                    <strong class="text-dark">Horário:</strong> &nbsp;
                                    <?= esc($config['valor']) ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="ModalEdit<?= $config['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?= base_url('admin/config/update') ?>" method="post">
                            <input type="hidden" name="id" value="<?= esc($config['id']) ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar <?= esc($legenda[$config['chave']] ?? $config['chave']) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <input type="time" name="valor" value="<?= esc($config['valor']) ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>