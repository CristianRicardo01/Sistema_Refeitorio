<?php

namespace App\Models;

use CodeIgniter\Model;

class SetoresModel extends Model
{
    protected $table = 'setores';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'ativo'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; // <- corrigido aqui
}
