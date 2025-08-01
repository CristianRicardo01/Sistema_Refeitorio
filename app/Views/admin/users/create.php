<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Painel do Admin<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Reservado para o CSS específico da página -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Aqui entra o conteúdo principal da users admin -->
<div class="container-fluid py-2">
    <div class="py-4">
        <div class="card">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Users create</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pt-2">
                <form method="post" action="<?= base_url('admin/users/store') ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="username" value="<?= old('username') ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-gradient-dark mb-0 me-4">
                        <i class="material-symbols-rounded text-sm">add</i>
                        &nbsp;&nbsp;Create User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Reservado para o JS específico da página -->
<?= $this->endSection() ?>