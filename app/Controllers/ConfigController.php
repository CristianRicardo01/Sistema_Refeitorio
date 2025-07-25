<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ConfigController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $configs = $this->db->table('configuracoes')->get()->getResultArray();

        return view('admin/config/index', ['configs' => $configs]);
    }

    public function salvar()
    {
        $keys = ['hora_inicio_almoco', 'hora_fim_almoco', 'hora_inicio_janta', 'hora_fim_janta'];

        foreach ($keys as $key) {
            $valor = $this->request->getPost($key);
            $this->db->table('configuracoes')->where('chave', $key)->update(['valor' => $valor]);
        }

        return redirect()->to('/admin/config')->with('msg', 'Configurações atualizadas com sucesso!');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $valor = $this->request->getPost('valor');

        if ($id && $valor) {
            $this->db->table('configuracoes')->where('id', $id)->update(['valor' => $valor]);
        }

        return redirect()->to('/admin/config')->with('msg', 'Horário atualizado com sucesso!');
    }
}
