<?php
$uri_path = trim(parse_url(current_url(), PHP_URL_PATH), '/');

// Remove prefixo admin/
if (strpos($uri_path, 'admin/') === 0) {
    $uri_path = substr($uri_path, strlen('admin/'));
}

// Quebra em segmentos
$segments = explode('/', $uri_path);

// Últimos elementos
$count = count($segments);
$last = $segments[$count - 1] ?? null;
$second_last = $segments[$count - 2] ?? null;
$third_last = $segments[$count - 3] ?? null;

// Tabela de nomes amigáveis
$base_names = [
    'dashboard'                 => 'Dashboard',
    'solicitacao'               => 'Solicitação',
    'relatorio'                 => 'Relatório', // remover no fim 
    // 'lancamentos'            => 'Lançamentos',
    'config'                    => 'Configuração',
    'cardapio'                  => 'Cardápio',
    'profile'                   => 'Perfil',
    'users'                     => 'Usuários',
    'importar-funcionarios'     => 'Importar Funcionarios',
];

$actions = [
    'edit'         => 'Editar',
    'create'       => 'Criar',
    'store'        => 'Criar',
    'update'       => 'Atualizar',
    'password'     => 'Senha',
];

// Lógica para escolher título principal
if (is_numeric($last)) {
    if (isset($base_names[$third_last])) {
        $main = $base_names[$third_last];
        $action = $actions[$second_last] ?? null;
    } else {
        $main = $base_names[$second_last] ?? ucfirst($second_last);
        $action = null;
    }
} elseif (isset($actions[$last])) {
    $main = $base_names[$second_last] ?? ucfirst($second_last);
    $action = $actions[$last];
} else {
    $main = $base_names[$last] ?? ucfirst($last);
    $action = null;
}
?>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?php echo base_url('/admin/dashboard') ?>">Pages</a></li>
                <?php if ($action): ?>
                    <li class="breadcrumb-item text-sm">
                        <a class="text-dark" href="javascript:void(0)"><?= esc($main) ?></a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        <span class="nav-link-text ms-1"><?= esc($action) ?></span>
                    </li>
                <?php else: ?>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        <span class="nav-link-text ms-1"><?= esc($main) ?></span>
                    </li>
                <?php endif; ?>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline"></div>
            </div>
            <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                <li class="nav-item d-xl-none px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item d-flex  align-items-center">
                    <a href="<?= base_url(session('user_role') . '/admin/profile/' . session('user_id')) ?>" class="nav-link text-body font-weight-bold px-0">
                        <i class="material-symbols-rounded">account_circle</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->