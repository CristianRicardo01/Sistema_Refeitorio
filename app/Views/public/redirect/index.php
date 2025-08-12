<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

// Detecta iOS
if (stripos($userAgent, 'iPhone') !== false || stripos($userAgent, 'iPad') !== false) {
    header("Location: ../cadastro/ios/index.php");
    exit;
}

// Detecta Android
if (stripos($userAgent, 'Android') !== false) {
    header("Location: ../cadastro/android/index.php");
    exit;
}

// Caso contrário, assume Desktop
header("Location: ../cadastro/desktop/index.php");
exit;
