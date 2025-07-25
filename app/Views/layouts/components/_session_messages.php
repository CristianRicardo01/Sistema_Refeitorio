<?php if (session()->has('success')): ?>
    <script>
        Toastify({
            text: "<?= esc(session('success')) ?>",
            duration: 10000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#4fbe87",
        }).showToast();
    </script>
<?php endif; ?>

<?php if (session()->has('info')): ?>
    <script>
        Toastify({
            text: "<?= esc(session('info')) ?>",
            duration: 10000,
            close: true,
            gravity: "top",
            position: "right",
        }).showToast();
    </script>
<?php endif; ?>

<?php if (session()->has('danger')): ?>
    <script>
        Toastify({
            text: "<?= esc(session('danger')) ?>",
            duration: 10000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#dc3545",
        }).showToast();
    </script>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <script>
        Toastify({
            text: "<?= esc(session('error')) ?>",
            duration: 10000,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#dc3545",
        }).showToast();
    </script>
<?php endif; ?>
