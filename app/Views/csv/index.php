<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
Importar Funcionários
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-2">
    <div class="py-4">
        <div class="card">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Importar Funcionários via CSV</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pt-2">
                <form action="<?= base_url('csv/importar-funcionarios/upload') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Selecione o arquivo CSV:</label>
                        <input class="form-control" type="file" id="csv_file" name="csv_file" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Importar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <p>O arquivo CSV deve ter o formato:</p>
            <p>
                <strong>matricula,nome<br></strong>
                <label>
                    10001,Fulano Beltrano <br>
                    10002,Beltrano Souza
                </label>
            </p>
        </div>
    </div>

    <?php if (session()->getFlashdata('funcionariosInseridos')): ?>
    <div class="card mt-4">
        <div class="card-header">
            <h6>Funcionários Importados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (session()->getFlashdata('funcionariosInseridos') as $funcionario): ?>
                            <tr>
                                <td><?= htmlspecialchars($funcionario['matricula']) ?></td>
                                <td><?= htmlspecialchars($funcionario['nome']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
