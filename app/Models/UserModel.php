<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'password',
        'role',
        'ativo',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true; // se tiver `created_at` e `updated_at`

}
