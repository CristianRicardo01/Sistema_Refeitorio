<?php

namespace App\Models;

use CodeIgniter\Model;

class CardapioModel extends Model
{
    protected $table = 'cardapios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dia_semana', 'updated_at'];
    protected $useTimestamps = false; // updated_at vamos atualizar manual
}
