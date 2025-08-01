<?php if ($pager->getPageCount() > 1): ?>
    <nav>
        <ul class="pagination">
            <?php if ($pager->hasPrevious()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="Primeira">&laquo;&laquo;</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Anterior">&laquo;</a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link): ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNext()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Próxima">&raquo;</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Última">&raquo;&raquo;</a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
<?php endif ?>