<?php

namespace App\Controllers;

use App\Models\FuncionarioModel;
use App\Models\RefeicaoModel;
use App\Models\RefeicoesModel;
use CodeIgniter\Controller;

class PublicoController extends Controller
{
    protected $funcionarioModel;
    protected $refeicaoModel;
    protected $refeicoesModel;

    public function __construct()
    {
        helper('meu'); // Se for o helper personalizado
        $this->funcionarioModel = new FuncionarioModel();
        $this->refeicaoModel = new RefeicaoModel();
        $this->refeicoesModel = new RefeicoesModel();
    }

    public function index()
    {
        return view('public/index');
    }

    public function registrar()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('/');
        }

        $matricula = trim($this->request->getPost('matricula'));

        if (empty($matricula)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Informe a matrícula.'
            ]);
        }

        $funcionario = $this->funcionarioModel->where('matricula', $matricula)->first();
        if (!$funcionario) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Funcionário não encontrado.'
            ]);
        }

        $now = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $horaAtual = $now->format('H:i');

        // Busca horários configurados
        $inicioCafeManha = getConfig('hora_inicio_cafe_manha');
        $fimCafeManha = getConfig('hora_final_cafe_manha');
        $inicioAlmoco = getConfig('hora_inicio_almoco');
        $fimAlmoco = getConfig('hora_fim_almoco');
        $inicioJanta = getConfig('hora_inicio_janta');
        $fimJanta = getConfig('hora_fim_janta');
        $inicioCafeMadrugada = getConfig('hora_inicio_cafe_madrugada');
        $fimCafeMadrugada = getConfig('hora_final_cafe_madrugada');

        $periodo = null;

        if ($horaAtual >= $inicioCafeManha && $horaAtual <= $fimCafeManha) {
            $periodo = 'cafe_manha';
        } elseif ($horaAtual >= $inicioAlmoco && $horaAtual <= $fimAlmoco) {
            $periodo = 'almoco';
        } elseif ($horaAtual >= $inicioJanta && $horaAtual <= $fimJanta) {
            $periodo = 'janta';
        } elseif ($horaAtual >= $inicioCafeMadrugada && $horaAtual <= $fimCafeMadrugada) {
            $periodo = 'cafe_madrugada';
        }

        if ($periodo === null) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Fora do horário permitido para registro.'
            ]);
        }

        $refeicao = $this->refeicoesModel->where('tipo', $periodo)->first();
        if (!$refeicao) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Tipo de refeição não configurado no sistema.'
            ]);
        }

        $hoje = $now->format('Y-m-d');

        if ($this->refeicaoModel->existe($funcionario['id'], $refeicao['id'], $hoje)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => "Você já registrou a refeição do período de {$periodo} hoje."
            ]);
        }

        $insertId = $this->refeicaoModel->inserir($funcionario['id'], $refeicao['id'], $hoje);

        if ($insertId) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Registro do {$periodo} realizado com sucesso!"
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Erro ao registrar a refeição. Tente novamente.'
            ]);
        }
    }

    public function cadastro()
    {
        return view('public/cadastro');
    }

    public function cadastrar() {
        
        $nome = trim($this->request->getPost('nome'));
        $matricula = trim($this->request->getPost('matricula'));

        if (empty($nome) || empty($matricula)) {
            return redirect()->back()->withInput()->with('error', 'Por favor, preencha todos os campos.');
        }

        // Garante apenas números
        if (!ctype_digit($matricula)) {
            return redirect()->back()->withInput()->with('error', 'O campo matrícula/CPF deve conter apenas números.');
        }

        // Validação matrícula ou CPF
        if (strlen($matricula) === 5) {
            if ($matricula[0] === '0') {
                return redirect()->back()->withInput()->with('error', 'A matrícula não pode começar com 0.');
            }
        } elseif (strlen($matricula) === 11) {
            $matricula = preg_replace('/[^0-9]/', '', $matricula);
            if (!$this->validarCPF($matricula)) {
                return redirect()->back()->withInput()->with('error', 'CPF inválido.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Digite uma matrícula com 5 dígitos ou um CPF com 11 dígitos.');
        }

        // Verifica duplicidade
        $jaExiste = $this->funcionarioModel
            ->where('matricula', $matricula)
            ->first();

        if ($jaExiste) {
            if (strlen($matricula) === 5) {
                return redirect()->back()->withInput()->with('error', 'Já existe um funcionário com essa matrícula.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Já existe um funcionário com esse CPF.');
            }
        }

        $this->funcionarioModel->insert([
            'nome' => strtoupper($nome),
            'matricula' => $matricula,
        ]);

        return redirect()->to('/cadastro')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    /**
     * Valida o CPF (estrutura e dígitos verificadores)
     */
    private function validarCPF($cpf)
    {
        // Remove não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}
