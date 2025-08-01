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
                        <div class="row justify-content-between px-3">
                            <div class="col d-flex align-items-center">
                                <h6 class="text-white text-capitalize mb-0">Colaboradores</h6>
                            </div>
                            <div class="col text-end">
                                <!-- Botão Lançar fora do loop -->
                                <button class="btn btn-sm btn-success" onclick="abrirModalRefeicao('')">
                                    Lançar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matrícula</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Criado em</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($funcionarios)): ?>
                                    <?php foreach ($funcionarios as $f): ?>
                                        <tr>
                                            <td>
                                                <p class="text-xs text-secondary mb-0"><?= esc($f['matricula']) ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0"><?= esc($f['nome']) ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0"><?= esc(date('d/m/Y', strtotime($f['created_at']))) ?></p>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" onclick="abrirModalEditar('<?= $f['id'] ?>', '<?= esc($f['nome']) ?>', '<?= esc($f['matricula']) ?>')">
                                                    Editar
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <p class="mb-0 text-sm">Nenhum colaborador encontrado.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <?= $pager->links('default', 'default_full') ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal: Editar Funcionário -->
<div class="modal fade" id="ModalEditarFuncionario" tabindex="-1" aria-labelledby="ModalEditarFuncionarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/colaborador/update') ?>" method="post">
            <input type="hidden" name="id" id="edit-func-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditarFuncionarioLabel">Editar Funcionário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula" id="edit-func-matricula" required>
                    </div>
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="edit-func-nome" required>
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

<!-- Modal: Registrar Refeição -->
<div class="modal fade" id="ModalRegistrarRefeicao" tabindex="-1" aria-labelledby="ModalRegistrarRefeicaoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('admin/registrar-refeicao') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRegistrarRefeicaoLabel">Registrar Refeição</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <!-- Campo de matrícula visível -->
                    <div class="input-group input-group-outline mb-3">
                        <label for="reg-matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula" id="reg-matricula" required>
                    </div>
                    <div class="input-group-outline mb-3">
                        <label for="refeicao" class="form-label">Tipo de Refeição</label>
                        <select class="form-select" name="refeicao_id" required>
                            <option value="">Selecione</option>
                            <?php foreach ($refeicoes as $ref): ?>
                                <option value="<?= $ref['id'] ?>"><?= ucfirst($ref['tipo']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JS: Modais -->
<script>
    function abrirModalEditar(id, nome, matricula) {
        document.getElementById('edit-func-id').value = id;
        document.getElementById('edit-func-nome').value = nome;
        document.getElementById('edit-func-matricula').value = matricula;
        const modal = new bootstrap.Modal(document.getElementById('ModalEditarFuncionario'));
        modal.show();
    }

    function abrirModalRefeicao(matricula) {
        document.getElementById('reg-matricula').value = matricula;
        const modal = new bootstrap.Modal(document.getElementById('ModalRegistrarRefeicao'));
        modal.show();
    }
</script>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- JS específico da página, se necessário -->
<?= $this->endSection() ?>