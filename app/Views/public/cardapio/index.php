<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cardápio Semanal - Hospital de Amor</title>
    <?= $this->include('layouts/components/icons') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff3d9;
            font-family: Arial, sans-serif;
        }
        h3 {
            color: #e53935;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="text-center mb-4">
            <img src="<?php echo base_url('assets/img/Hospital.png') ?>" alt="Hospital de Amor" class="img-fluid" style="max-height:120px;">
        </div>
        <div class="text-center mb-4">
            <h1>Cardápio - <?= getCardapioPeriodo() ?></h1>
        </div>
        <div class="row g-4">
            <?php foreach ($cardapios as $cardapio): ?>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="bg-white rounded-4 shadow p-3 h-100">
                        <h3 class="text-center fs-5"><?= esc($cardapio['dia_semana']) ?></h3>
                        <ul class="list-unstyled small">
                            <?php
                            $itensFiltrados = array_filter($itensPorCardapio[$cardapio['id']] ?? [], function($item) {
                                return $item['tipo'] == getTipoCardapio();
                            });
                            ?>
                            <?php if (!empty($itensFiltrados)): ?>
                                <?php foreach ($itensFiltrados as $item): ?>
                                    <li>- <?= esc($item['nome']) ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="text-center"><em>Sem itens cadastrados</em></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <img src="<?php echo base_url('assets/img/Mascote.png') ?>" alt="Chef Elephant" class="img-fluid" style="max-height:250px;">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
function getTipoCardapio() {
    $horaAtual = (int)date('H');
    return ($horaAtual >= 6 && $horaAtual < 17) ? 0 : 1; // 0 para almoço, 1 para janta
    // return ($horaAtual <= 6 && $horaAtual > 17) ? 0 : 1; // 0 para almoço, 1 para janta
}

function getCardapioPeriodo() {
    return getTipoCardapio() == 0 ? 'Almoço' : 'Janta';
}
?>
