<?php
namespace App\Models;

use CodeIgniter\Model;

class ConfigModel extends Model
{
    protected $table = 'configuracoes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['chave', 'valor']; // Certifique-se de que 'valor' está incluído aqui
}
