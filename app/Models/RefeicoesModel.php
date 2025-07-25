<?php
namespace App\Models;

use CodeIgniter\Model;

class RefeicoesModel extends Model
{
    protected $table = 'refeicoes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tipo'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
