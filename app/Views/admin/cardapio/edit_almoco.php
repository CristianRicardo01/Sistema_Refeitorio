<?= $this->extend('Layouts/admin') ?>

<?= $this->section('title') ?>
Editar <?= ucfirst($cardapio['dia_semana']) ?> - Almoço
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
                                <h6 class="text-white text-capitalize ps-3 mb-0">
                                    Editar Cardápio (Almoço): <?= ucfirst($cardapio['dia_semana']) ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container py-4">
                    <div class="col-xl-6 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl">
                                <img src="<?= base_url('assets/img/illustrations/pattern-tree.svg') ?>" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                                <span class="mask bg-gradient-dark opacity-30"></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <form action="<?= base_url('admin/cardapio/update_almoco/' . $cardapio['id']) ?>" method="post">

                                                <!-- tipo oculto (0 = Almoço) -->
                                                <input type="hidden" name="tipo" value="0">

                                                <div id="itens-container">
                                                    <?php if (!empty($itens)): ?>
                                                        <?php foreach ($itens as $i => $item): ?>
                                                            <div class="mb-2 d-flex align-items-center gap-2">
                                                                <input type="text" name="itens[]" value="<?= esc($item['nome']) ?>" class="form-control text-white" placeholder="Item <?= $i + 1 ?>">
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="removerItem(this)">X</button>
                                                            </div>
                                                        <?php endforeach ?>
                                                    <?php else: ?>
                                                        <div class="mb-2 d-flex align-items-center gap-2">
                                                            <input type="text" name="itens[]" class="form-control text-white" placeholder="Item 1">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removerItem(this)">X</button>
                                                        </div>
                                                    <?php endif ?>
                                                </div>

                                                <div class="row">
                                                    <div class="col d-flex gap-3">
                                                        <div>
                                                            <button type="button" class="btn btn-secondary" onclick="addItem()">Adicionar Item</button>
                                                        </div>
                                                        <div>
                                                            <button type="submit" class="btn btn-success">Salvar</button>
                                                        </div>
                                                        <div>
                                                            <a class="btn btn-primary" href="<?= base_url('/admin/cardapio') ?>">Voltar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="ms-auto w-20 d-flex align-items-end justify-content-end"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    function addItem() {
        const container = document.getElementById('itens-container');
        const div = document.createElement('div');
        div.className = 'mb-2 d-flex align-items-center gap-2';
        div.innerHTML = `
            <input type="text" name="itens[]" class="form-control text-white" placeholder="Novo Item">
            <button type="button" class="btn btn-danger btn-sm" onclick="removerItem(this)">X</button>
        `;
        container.appendChild(div);
    }

    function removerItem(button) {
        button.parentElement.remove();
    }
</script>
<?= $this->endSection() ?>