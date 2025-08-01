<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;

class AdminController extends Controller
{
    protected $db;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $hoje = date('Y-m-d');

        // Total geral
        $totalQuery = $this->db->table('lancamentos')
            ->selectCount('id', 'total')
            ->get()->getRowArray();
        $total = $totalQuery['total'] ?? 0;

        // Total almoço
        $almocoQuery = $this->db->table('lancamentos rf')
            ->join('refeicoes r', 'r.id = rf.refeicao_id')
            ->where('r.tipo', 'almoço')
            ->selectCount('rf.id', 'total')
            ->get()->getRowArray();
        $total_almoco = $almocoQuery['total'] ?? 0;

        // Total janta
        $jantaQuery = $this->db->table('lancamentos rf')
            ->join('refeicoes r', 'r.id = rf.refeicao_id')
            ->where('r.tipo', 'janta')
            ->selectCount('rf.id', 'total')
            ->get()->getRowArray();
        $total_janta = $jantaQuery['total'] ?? 0;

        // Total almoço hoje
        $almocoHojeQuery = $this->db->table('lancamentos rf')
            ->join('refeicoes r', 'r.id = rf.refeicao_id')
            ->where('r.tipo', 'almoço')
            ->where('rf.data', $hoje)
            ->selectCount('rf.id', 'total')
            ->get()->getRowArray();
        $total_almoco_hoje = $almocoHojeQuery['total'] ?? 0;

        // Total janta hoje
        $jantaHojeQuery = $this->db->table('lancamentos rf')
            ->join('refeicoes r', 'r.id = rf.refeicao_id')
            ->where('r.tipo', 'janta')
            ->where('rf.data', $hoje)
            ->selectCount('rf.id', 'total')
            ->get()->getRowArray();
        $total_janta_hoje = $jantaHojeQuery['total'] ?? 0;

        // Total geral hoje
        $totalHojeQuery = $this->db->table('lancamentos')
            ->where('data', $hoje)
            ->selectCount('id', 'total')
            ->get()->getRowArray();
        $total_hoje = $totalHojeQuery['total'] ?? 0;

        return view('admin/dashboard/index', [
            'total' => $total,
            'total_almoco' => $total_almoco,
            'total_janta' => $total_janta,
            'total_almoco_hoje' => $total_almoco_hoje,
            'total_janta_hoje' => $total_janta_hoje,
            'total_hoje' => $total_hoje
        ]);
    }

    public function profile($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Usuário com ID {$id} não encontrado.");
        }

        return view('admin/profile/index', ['user' => $user]);
        // return view('admin/profile/index');
    }

    public function users()
    {
        $users = $this->db->table('usuarios')->get()->getResultArray();
        foreach ($users as &$u) {
            $u['status'] = ($u['ativo'] == 1) ? 'ativo' : 'inativo';
        }
        return view('admin/users/index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin/users/create');
    }

    public function store()
    {
        $request = $this->request;
        $userModel = new UserModel();

        $data = [
            'username' => $request->getPost('username'),
            'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $request->getPost('role') ?? 'user',
            'ativo'    => 1
        ];

        // dd($data);

        $userModel->insert($data);

        return redirect()->to('/admin/users')->with('success', 'Usuário criado com sucesso!');
    }

    public function updateProfile()
    {
        $userId = $this->request->getPost('id');

        $data = [
            'username'  => $this->request->getPost('username'),
        ];

        if (!$this->userModel->update($userId, $data)) {
            return redirect()->back()->with('error', 'Erro ao atualizar perfil.');
        }

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }

    // Atualizar senha
    public function updatePassword()
    {
        $userId = $this->request->getPost('id');
        $pass1  = $this->request->getPost('password');
        $pass2  = $this->request->getPost('confirm_password');

        if ($pass1 !== $pass2) {
            return redirect()->back()->with('error', 'As senhas não coincidem.');
        }

        $data = [
            'password' => password_hash($pass1, PASSWORD_DEFAULT),
        ];

        if (!$this->userModel->update($userId, $data)) {
            return redirect()->back()->with('error', 'Erro ao atualizar senha.');
        }

        return redirect()->back()->with('success', 'Senha alterada com sucesso!');
    }

    public function solicitacao()
    {
        $data_inicio = $this->request->getGet('data_inicio');
        $data_fim = $this->request->getGet('data_fim');
        $tipo = $this->request->getGet('tipo');

        $perPage = 10;
        $builder = $this->db->table('lancamentos rf')
            ->select('f.nome, f.matricula, r.tipo, rf.data, rf.created_at, s.nome as setor_nome')
            ->join('funcionarios f', 'f.id = rf.funcionario_id')
            ->join('refeicoes r', 'r.id = rf.refeicao_id')
            ->join('setores s', 's.id = rf.setor_id', 'left');  // <-- Aqui o join correto para setor

        if ($data_inicio) $builder->where('rf.data >=', $data_inicio);
        if ($data_fim) $builder->where('rf.data <=', $data_fim);
        if ($tipo) $builder->where('r.tipo', $tipo);

        $builder->orderBy('rf.data', 'desc');

        $page = (int) ($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $total = $builder->countAllResults(false);
        $registros = $builder->limit($perPage, $offset)->get()->getResultArray();

        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total);

        return view('admin/solicitacao', [
            'registros' => $registros,
            'data_inicio' => $data_inicio,
            'data_fim' => $data_fim,
            'tipo' => $tipo,
            'pager' => $pager
        ]);
    }


    public function relatorio()
    {
        $data_inicio = $this->request->getGet('data_inicio');
        $data_fim    = $this->request->getGet('data_fim');
        $tipo        = $this->request->getGet('tipo');
        $matricula   = $this->request->getGet('matricula');
        $setor       = $this->request->getGet('setor');

        $perPage = 10;
        $page    = (int)($this->request->getGet('page') ?? 1);
        $offset  = ($page - 1) * $perPage;

        $builder = $this->db->table('lancamentos l')
            ->select('f.nome, f.matricula, r.tipo, l.data, l.created_at, s.nome as setor')
            ->join('funcionarios f', 'f.id = l.funcionario_id')
            ->join('refeicoes r', 'r.id = l.refeicao_id')
            ->join('setores s', 's.id = l.setor_id', 'left'); // <-- Correto!


        if ($data_inicio) $builder->where('l.data >=', $data_inicio);
        if ($data_fim)    $builder->where('l.data <=', $data_fim);
        if ($tipo)        $builder->where('r.tipo', $tipo);
        if ($matricula)   $builder->where('f.matricula', $matricula);
        if ($setor)       $builder->where('s.nome', $setor);

        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults(false);

        $dataBuilder = clone $builder;
        $registros = $dataBuilder->limit($perPage, $offset)->orderBy('l.data', 'desc')->get()->getResultArray();

        // Buscar lista de setores (únicos)
        $setorBuilder = $this->db->table('setores')
            ->select('nome')
            ->where('ativo', 1)
            ->orderBy('nome');
        $setores = array_column($setorBuilder->get()->getResultArray(), 'nome');

        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total);

        return view('admin/relatorio', [
            'registros'    => $registros,
            'data_inicio'  => $data_inicio,
            'data_fim'     => $data_fim,
            'tipo'         => $tipo,
            'matricula'    => $matricula,
            'pager'        => $pager,
            'setor'        => $setor,
            'setores'      => $setores,
        ]);
    }

    public function exportarPdf()
    {
        $data_inicio = $this->request->getGet('data_inicio');
        $data_fim = $this->request->getGet('data_fim');
        $tipo = trim($this->request->getGet('tipo') ?? '');
        $matricula = $this->request->getGet('matricula');

        $builder = $this->db->table('lancamentos l')
            ->select('f.nome, f.matricula, r.tipo, l.data, l.created_at, s.nome as setor')
            ->join('funcionarios f', 'f.id = l.funcionario_id')
            ->join('refeicoes r', 'r.id = l.refeicao_id')
            ->join('setores s', 's.id = l.setor_id', 'left'); // <-- Correto!

        if ($data_inicio) $builder->where('l.data >=', $data_inicio);
        if ($data_fim) $builder->where('l.data <=', $data_fim);
        if ($tipo !== '') $builder->where('r.tipo', $tipo);
        if ($matricula) $builder->where('f.matricula', $matricula);

        $registros = $builder->orderBy('l.data', 'desc')->get()->getResultArray();

        $dompdf = new \Dompdf\Dompdf();
        $html = view('admin/pdf_template', ['registros' => $registros]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('relatorio.pdf');
    }


    public function exportarCsv()
    {
        $data_inicio = $this->request->getGet('data_inicio');
        $data_fim = $this->request->getGet('data_fim');
        $tipo = trim($this->request->getGet('tipo') ?? '');
        $matricula = $this->request->getGet('matricula');

        $builder = $this->db->table('lancamentos l')
            ->select('f.nome, f.matricula, s.nome as setor, r.tipo, l.data, l.created_at')
            ->join('funcionarios f', 'f.id = l.funcionario_id')
            ->join('refeicoes r', 'r.id = l.refeicao_id')
            ->join('setores s', 's.id = l.setor_id', 'left'); // <-- CORRIGIDO AQUI

        if ($data_inicio) $builder->where('l.data >=', $data_inicio);
        if ($data_fim) $builder->where('l.data <=', $data_fim);
        if ($tipo !== '') $builder->where('r.tipo', $tipo);
        if ($matricula) $builder->where('f.matricula', $matricula);

        $registros = $builder->orderBy('l.data', 'desc')->get()->getResultArray();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="relatorio.csv"');

        $f = fopen('php://output', 'w');
        fputcsv($f, ['Nome', 'Matrícula', 'Setor', 'Tipo', 'Data', 'Registrado em']);
        foreach ($registros as $r) {
            fputcsv($f, [
                $r['nome'],
                $r['matricula'],
                $r['setor'] ?? 'N/A',
                $r['tipo'],
                $r['data'],
                $r['created_at']
            ]);
        }
        fclose($f);
        exit;
    }



    public function toggleStatus()
    {
        $userId = $this->request->getPost('user_id');
        $action = $this->request->getPost('action');

        if (!$userId || !$action) {
            return $this->response->setJSON(['error' => 'Dados inválidos.'])->setStatusCode(400);
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            return $this->response->setJSON(['error' => 'Usuário não encontrado.'])->setStatusCode(404);
        }

        $novoStatus = ($action === 'ativar') ? 1 : 0;

        $this->userModel->update($userId, [
            'ativo' => $novoStatus,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON(['success' => 'Status atualizado com sucesso.', 'novo_status' => $novoStatus]);
    }

    public function colaborador()
    {
        $funcionarioModel = new \App\Models\FuncionarioModel();
        $refeicoesModel = new \App\Models\RefeicoesModel();

        $perPage = 10;

        // Paginar com caminho correto
        $funcionarios = $funcionarioModel->paginate($perPage, 'default');
        $pager = $funcionarioModel->pager;
        $pager->setPath('admin/colaborador'); // ajusta a URL base da paginação

        $refeicoes = $refeicoesModel->findAll(); // Dados para o modal de refeição

        return view('admin/colaborador/index', [
            'funcionarios' => $funcionarios,
            'refeicoes' => $refeicoes,
            'pager' => $pager
        ]);
    }

    public function updateColaborador()
    {
        $id = $this->request->getPost('id');
        $nome = $this->request->getPost('nome');
        $matricula = $this->request->getPost('matricula');

        if (!$id || !$nome || !$matricula) {
            return redirect()->back()->with('error', 'Dados incompletos.');
        }

        $funcionarioModel = new \App\Models\FuncionarioModel();

        if (!$funcionarioModel->find($id)) {
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        $funcionarioModel->update($id, [
            'nome' => $nome,
            'matricula' => $matricula,
        ]);

        return redirect()->back()->with('success', 'Funcionário atualizado com sucesso.');
    }

    public function registrarRefeicao()
    {
        $matricula = $this->request->getPost('matricula');
        $refeicao_id = $this->request->getPost('refeicao_id');

        if (!$matricula || !$refeicao_id) {
            return redirect()->back()->with('error', 'Preencha todos os campos.');
        }

        $funcionarioModel = new \App\Models\FuncionarioModel();
        $refeicoesModel = new \App\Models\RefeicoesModel();

        $funcionario = $funcionarioModel->where('matricula', $matricula)->first();
        $refeicao = $refeicoesModel->find($refeicao_id);

        if (!$funcionario) {
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        if (!$refeicao) {
            return redirect()->back()->with('error', 'Tipo de refeição inválido.');
        }

        $this->db->table('lancamentos')->insert([
            'funcionario_id' => $funcionario['id'],
            'refeicao_id'    => $refeicao_id,
            'data'           => date('Y-m-d'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Refeição registrada com sucesso!');
    }

    public function registrarRefeicaoMarmita()
    {
        $matricula  = $this->request->getPost('matricula');
        $refeicaoId = $this->request->getPost('refeicao_id');
        $setorId    = $this->request->getPost('setor_id');

        if (!$matricula || !$refeicaoId || !$setorId) {
            return redirect()->back()->with('error', 'Preencha todos os campos.');
        }

        $funcionarioModel = new \App\Models\FuncionarioModel();
        $refeicoesModel   = new \App\Models\RefeicoesModel();
        $setoresModel     = new \App\Models\SetoresModel();

        $funcionario = $funcionarioModel->where('matricula', $matricula)->first();
        $refeicao    = $refeicoesModel->find($refeicaoId);
        $setor       = $setoresModel->find($setorId);

        if (!$funcionario) {
            return redirect()->back()->with('error', 'Funcionário não encontrado.');
        }

        if (!$refeicao) {
            return redirect()->back()->with('error', 'Tipo de refeição inválido.');
        }

        if (!$setor || $setor['ativo'] != 1) {
            return redirect()->back()->with('error', 'Setor inválido ou inativo.');
        }

        // Verifica duplicidade
        $db = \Config\Database::connect();
        $builder = $db->table('lancamentos');
        $registroExistente = $builder
            ->where('funcionario_id', $funcionario['id'])
            ->where('refeicao_id', $refeicaoId)
            ->where('data', date('Y-m-d'))
            ->get()
            ->getRow();

        if ($registroExistente) {
            return redirect()->back()->with('error', 'Funcionário já registrou esta refeição hoje.');
        }

        $builder->insert([
            'funcionario_id' => $funcionario['id'],
            'refeicao_id'    => $refeicaoId,
            'setor_id'       => $setorId,
            'data'           => date('Y-m-d'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Marmita registrada com sucesso!');
    }
}
