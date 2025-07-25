<?php

namespace App\Models;

use CodeIgniter\Model;

class CardapioItemModel extends Model
{
    protected $table = 'cardapio_itens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cardapio_id', 'nome', 'tipo'];
}
