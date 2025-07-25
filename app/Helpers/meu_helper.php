<?php

use Config\Database;

if (!function_exists('getConfig')) {
    function getConfig($chave)
    {
        static $cache = null;
        if ($cache === null) {
            $db = Database::connect();
            $configs = $db->table('configuracoes')->get()->getResultArray();
            $cache = array_column($configs, 'valor', 'chave');
        }
        return $cache[$chave] ?? null;
    }
}
