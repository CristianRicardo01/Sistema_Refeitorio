<?php
namespace App\Models;

use CodeIgniter\Model;

class RefeicaoModel extends Model
{
    protected $table = 'lancamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['funcionario_id', 'refeicao_id', 'data'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Verifica se já existe um lançamento para o funcionário, refeição e data passados.
     *
     * @param int $funcionarioId
     * @param int $refeicaoId
     * @param string $data (formato 'Y-m-d')
     * @return bool
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
     * Insere um novo lançamento para o funcionário, refeição e data.
     *
     * @param int $funcionarioId
     * @param int $refeicaoId
     * @param string $data (formato 'Y-m-d')
     * @return int|false Retorna o ID inserido ou false em caso de erro
     */
    public function inserir($funcionarioId, $refeicaoId, $data)
    {
        return $this->insert([
            'funcionario_id' => $funcionarioId,
            'refeicao_id'    => $refeicaoId,
            'data'           => $data
        ]);
    }
}
