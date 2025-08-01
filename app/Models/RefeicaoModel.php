<?php

namespace App\Models;

use CodeIgniter\Model;

class RefeicaoModel extends Model
{
    protected $table = 'lancamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['funcionario_id', 'refeicao_id', 'data', 'setor_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Verifica se já existe um registro de refeição para o funcionário, refeição e data especificados.
     *
     * @param int $funcionarioId ID do funcionário
     * @param int $refeicaoId ID da refeição
     * @param string $data Data da refeição
     * @return bool Retorna true se existir, caso contrário false
     */
    public function existe($funcionarioId, $refeicaoId, $data): bool
    {
        return $this->where([
            'funcionario_id' => $funcionarioId,
            'refeicao_id'    => $refeicaoId,
            'data'           => $data
        ])->countAllResults() > 0;
    }

    /**
     * Insere um novo registro de refeição.
     *
     * @param int $funcionarioId ID do funcionário
     * @param int $refeicaoId ID da refeição
     * @param string $data Data da refeição
     * @param int|null $setorId ID do setor (opcional)
     * @return bool Retorna true se a inserção for bem-sucedida, caso contrário false
     */
    public function inserir($funcionarioId, $refeicaoId, $data, $setorId = null)
    {
        return $this->insert([
            'funcionario_id' => $funcionarioId,
            'refeicao_id'    => $refeicaoId,
            'data'           => $data,
            'setor_id'       => $setorId
        ]);
    }
}
