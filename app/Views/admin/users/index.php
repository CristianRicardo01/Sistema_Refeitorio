<?= $this->extend('Layouts/admin') ?>

<?= $this->section('title') ?>Usuários<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header bg-gradient-dark d-flex justify-content-between align-items-center">
                    <h6 class="text-white mb-0">Lista de Usuários</h6>
                    <a href="<?= base_url('admin/users/create') ?>" class="btn btn-sm bg-gradient-primary">
                        <i class="material-symbols-rounded text-sm">add</i> Novo Usuário
                    </a>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Senha</th>
                                    <th class="text-center">Criado em</th>
                                    <th class="text-center">Atualizado em</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($users)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-sm">Nenhum usuário cadastrado.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr id="user-row-<?= $user['id'] ?>">
                                            <td>
                                                <h6 class="mb-0 text-sm"><?= esc($user['username']) ?></h6>
                                                <p class="text-xs text-secondary mb-0"><?= esc($user['role']) ?></p>
                                            </td>

                                            <td class="text-center">
                                                <span id="status-badge-<?= $user['id'] ?>" class="badge bg-gradient-<?= $user['ativo'] ? 'success' : 'secondary' ?> badge-sm">
                                                    <?= $user['ativo'] ? 'Ativo' : 'Inativo' ?>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <?php if ($user['id'] != 1): ?> <!-- FILTRO APLICADO AQUI -->
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
                                                    <p class="text-xs text-secondary mb-0">Alterar Senha</p>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center text-xs"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>

                                            <td class="text-center text-xs"><?= date('d/m/Y', strtotime($user['updated_at'])) ?></td>

                                            <td class="text-center text-xs">
                                                <?php if ($user['id'] != 1): ?> <!-- FILTRO APLICADO AQUI -->
                                                    <button class="btn btn-sm btn-<?= $user['ativo'] ? 'warning' : 'success' ?> toggle-status-btn"
                                                        data-id="<?= $user['id'] ?>"
                                                        data-name="<?= esc($user['username']) ?>"
                                                        data-action="<?= $user['ativo'] ? 'inativar' : 'ativar' ?>">
                                                        <?= $user['ativo'] ? 'Inativar' : 'Ativar' ?>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Modal Alterar Senha -->
<div class="modal fade" id="ModalPassword" tabindex="-1" aria-labelledby="ModalPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('/admin/profile/update/password') ?>" method="post">
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


<script>
    document.querySelectorAll('.toggle-status-btn').forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.dataset.id;
            const action = button.dataset.action;
            const username = button.dataset.name;

            if (!confirm(`Deseja realmente ${action} o usuário "${username}"?`)) return;

            fetch("<?= base_url('admin/users/status') ?>", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `user_id=${userId}&action=${action}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const badge = document.getElementById(`status-badge-${userId}`);
                        badge.className = `badge bg-gradient-${data.novo_status == 1 ? 'success' : 'secondary'} badge-sm`;
                        badge.textContent = data.novo_status == 1 ? 'Ativo' : 'Inativo';

                        button.className = `btn btn-sm btn-${data.novo_status == 1 ? 'warning' : 'success'} toggle-status-btn`;
                        button.textContent = data.novo_status == 1 ? 'Inativar' : 'Ativar';
                        button.dataset.action = data.novo_status == 1 ? 'inativar' : 'ativar';
                    } else {
                        alert(data.error || 'Erro ao atualizar status.');
                    }
                })
                .catch(() => alert('Erro na requisição.'));
        });
    });
</script>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>