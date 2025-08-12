<?php
namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\SetoresModel;
use CodeIgniter\Controller;

class ConfigController extends Controller
{
    protected $configModel;
    protected $setoresModel;

    public function __construct()
    {
        $this->configModel = new ConfigModel();
        $this->setoresModel = new SetoresModel();
    }

    public function index()
    {
        $configs = $this->configModel->findAll();
        $setores = $this->setoresModel->findAll();
        return view('admin/config/index', ['configs' => $configs, 'setores' => $setores]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $valor = $this->request->getPost('valor');

        if ($id && $valor) {
            // Verifique se o registro existe antes de tentar atualizar
            $config = $this->configModel->find($id);

            if ($config) {
                $this->configModel->update($id, ['valor' => $valor]);
                return redirect()->to('/admin/config')->with('msg', 'Horário atualizado com sucesso!');
            } else {
                return redirect()->to('/admin/config')->with('error', 'Registro não encontrado!');
            }
        }

        return redirect()->to('/admin/config')->with('error', 'Dados inválidos!');
    }

    public function addSetor()
    {
        $nome = $this->request->getPost('nome');
        if ($nome) {
            $this->setoresModel->insert(['nome' => mb_strtoupper($nome, 'UTF-8'), 'ativo' => 0]);
        }
        return redirect()->to('/admin/config')->with('msg', 'Setor adicionado com sucesso!');
    }

    public function toggleSetor($id)
    {
        $setor = $this->setoresModel->find($id);
        if ($setor) {
            $novoEstado = $setor['ativo'] == 1 ? 0 : 1;
            $this->setoresModel->update($id, ['ativo' => $novoEstado]);
        }
        return redirect()->to('/admin/config')->with('msg', 'Estado do setor atualizado com sucesso!');
    }
}
