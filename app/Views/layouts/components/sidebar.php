<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="<?php echo base_url('/admin/dashboard') ?>">
            <img src="<?= base_url() ?>assets/img/Hospital.png" class="navbar-brand-img" width="40" height="60" alt="main_logo">
            <span class="ms-1 text-sm text-dark">Refeitorio</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/dashboard')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('/admin/dashboard') ?>">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/solicitacao')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('admin/solicitacao') ?>">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Solicitação</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/relatorio')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('admin/relatorio') ?>">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Relatorio</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/colaborador')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('admin/colaborador') ?>">
                    <i class="material-symbols-rounded opacity-5">groups</i>
                    <span class="nav-link-text ms-1">Colaborador</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/cardapio')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('admin/cardapio') ?>">
                    <i class="material-symbols-rounded opacity-5">view_timeline</i>
                    <span class="nav-link-text ms-1">Cardapio</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/config')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('admin/config') ?>">
                    <i class="material-symbols-rounded opacity-5">settings</i>
                    <span class="nav-link-text ms-1">Configuração</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('csv/importar-funcionarios')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('csv/importar-funcionarios') ?>">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Importar CSV</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/profile')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?= base_url(session('user_role') . '/admin/profile/' . session('user_id')) ?>">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo strpos(current_url(), base_url('admin/users')) === 0 ? 'active bg-gradient-dark text-white' : 'text-dark'; ?> " href="<?php echo base_url('admin/users') ?>">
                    <i class="material-symbols-rounded opacity-5">groups</i>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="<?= base_url('/logout') ?>">
                    <i class="material-symbols-rounded opacity-5">login</i>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
        </ul>
    </div>
</aside>