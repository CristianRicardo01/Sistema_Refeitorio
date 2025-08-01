<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Painel do Admin<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Adicione CSS específico da página aqui -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?php echo base_url('assets/img/photo-1531512073830-ba890ca4eba2.avif') ?>');">
        <span class="mask bg-gradient-dark opacity-6"></span>
    </div>

    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row">
            <div class="tab-content">
                <!-- Tela principal - APP -->
                <div class="tab-pane fade show active" id="app" role="tabpanel">
                    <div class="row">
                        <div class="col-12 col-xl-4">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h4 class="mb-0">Profile Information</h4>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#ModalProfile">
                                                <i class="material-symbols-rounded ms-auto text-dark cursor-pointer"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Edit Profile"
                                                    data-id="<?= $user['id'] ?>"
                                                    data-name="<?= esc($user['username']) ?>">
                                                    edit
                                                </i>
                                            </a>
                                        </div>

                                        <div class="col-md-2 text-end">
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#ModalPassword">
                                                <i class="material-symbols-rounded ms-auto text-dark cursor-pointer"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Edit Password"
                                                    data-id="<1?= $user['id'] ?>"
                                                    data-password="<1?= esc($user['password']) ?>">
                                                    lock_open
                                                </i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                            <strong class="text-dark">Email:</strong> &nbsp; <?= esc($user['username']) ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Editar Perfil -->
<div class="modal fade" id="ModalProfile" tabindex="-1" aria-labelledby="ModalProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/profile/update') ?>" method="post">
            <input type="hidden" name="id" value="<?= esc($user['id']) ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalProfileLabel">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label for="profile-name" class="form-label">Email</label>
                        <input type="email" class="form-control" name="username" value="<?= esc($user['username']) ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Alterar Senha -->
<div class="modal fade" id="ModalPassword" tabindex="-1" aria-labelledby="ModalPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/profile/update/password') ?>" method="post">
            <input type="hidden" name="id" value="<?= esc($user['id']) ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alterar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" name="password" required minlength="8">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Nova Senha</label>
                        <input type="password" class="form-control" name="confirm_password" required minlength="8">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Atualizar Senha</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>