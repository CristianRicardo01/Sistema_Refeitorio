<?= $this->extend('Layouts/admin') ?>

<?= $this->section('title') ?>
Cadastro
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
                                <h6 class="text-white text-capitalize ps-3 mb-0">Cardapio</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container py-2">
                    <div class="row">
                        <?php foreach ($cardapios as $cardapio): ?>
                            <div class="col-md-3 my-4">
                                <div class="card" data-animation="true">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <a class="d-block blur-shadow-image" style="background-color: #C0C0C0; border-radius: 15px;">
                                            <img src="<?php echo base_url('assets/img/Mascote.png') ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                        </a>
                                    </div>
                                    <div class="card-body text-center">

                                        <div class="d-flex mt-n6 mx-auto">
                                            <!-- Botão Almoço -->
                                            <a href="<?= base_url('admin/cardapio/edit_almoco/' . $cardapio['id']) ?>"
                                                class="btn btn-link text-primary ms-auto border-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                title="Editar Almoço"
                                                style="text-decoration: none;">
                                                <i class="material-symbols-rounded text-lg">sunny</i>
                                            </a>

                                            <!-- Botão Janta -->
                                            <a href="<?= base_url('admin/cardapio/edit_janta/' . $cardapio['id']) ?>"
                                                class="btn btn-link text-info me-auto border-0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                title="Editar Janta"
                                                style="text-decoration: none;">
                                                <i class="material-symbols-rounded text-lg">moon_stars</i>
                                            </a>
                                        </div>

                                        <h5 class="card-title"><?= ucfirst($cardapio['dia_semana']) ?></h5>

                                        <?php
                                        $itensAlmoco = array_filter($itensPorCardapio[$cardapio['id']] ?? [], fn($item) => $item['tipo'] == 0);
                                        $itensJanta = array_filter($itensPorCardapio[$cardapio['id']] ?? [], fn($item) => $item['tipo'] == 1);
                                        ?>

                                        <h6>Almoço</h6>
                                        <?php if (!empty($itensAlmoco)): ?>
                                            <ul class="list-unstyled mb-2">
                                                <?php foreach ($itensAlmoco as $item): ?>
                                                    <li>- <?= esc($item['nome']) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <p class="text-muted">Nenhum item de almoço cadastrado.</p>
                                        <?php endif; ?>

                                        <h6>Janta</h6>
                                        <?php if (!empty($itensJanta)): ?>
                                            <ul class="list-unstyled mb-0">
                                                <?php foreach ($itensJanta as $item): ?>
                                                    <li>- <?= esc($item['nome']) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <p class="text-muted">Nenhum item de janta cadastrado.</p>
                                        <?php endif; ?>
                                    </div>
                                    <hr class="dark horizontal my-0">
                                    <div class="card-footer d-flex text-center justify-content-center">
                                        <p class="font-weight-normal my-auto" style="font-size: 12px;">
                                            Última atualização: <?= !empty($cardapio['updated_at']) ? date('d/m/Y H:i', strtotime($cardapio['updated_at'])) : 'Nunca' ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>