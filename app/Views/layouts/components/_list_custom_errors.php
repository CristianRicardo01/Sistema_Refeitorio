<!-- Mensagem de sucesso -->
<?php if (session()->getFlashdata('success')): ?>
    <div id="flash-message" class="alert alert-success text-white" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Mensagens de erro -->
<?php if (session()->getFlashdata('errors')): ?>
    <?php foreach (session()->getFlashdata('errors') as $error): ?>
        <div class="alert alert-danger text-white flash-error" role="alert">
            <?= esc($error) ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
