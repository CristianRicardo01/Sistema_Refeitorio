<?php

namespace App\Controllers;

use App\Models\FuncionarioModel;
use CodeIgniter\Controller;

class FuncionarioImportController extends Controller
{
    public function index()
    {
        return view('csv/index');
    }

    public function upload()
    {
        $file = $this->request->getFile('csv_file');

        if (!$file->isValid() || $file->getExtension() !== 'csv') {
            return redirect()->back()->with('error', 'Por favor, envie um arquivo CSV válido.');
        }

        $filePath = $file->getTempName();
        $csvData = array_map('str_getcsv', file($filePath));

        if (isset($csvData[0]) && strtolower($csvData[0][0]) === 'matricula') {
            array_shift($csvData);
        }

        $funcionarioModel = new FuncionarioModel();

        // Pega todas as matrículas já cadastradas para evitar duplicatas
        $matriculasExistentes = $funcionarioModel->whereIn('matricula', array_column($csvData, 0))
            ->findColumn('matricula');

        $dadosParaInserir = [];
        $funcionariosInseridos = [];

        foreach ($csvData as $linha) {
            if (count($linha) >= 2) {
                $matricula = trim($linha[0]);
                $nome = trim($linha[1]);

                // Remove acentos do nome
                $nome = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $nome);

                // Converte o nome para maiúsculas
                $nome = mb_strtoupper($nome, 'UTF-8');

                // Só adiciona se não existir no banco
                if (!in_array($matricula, $matriculasExistentes)) {
                    $dadosParaInserir[] = [
                        'matricula' => $matricula,
                        'nome' => $nome
                    ];
                    $funcionariosInseridos[] = [
                        'matricula' => $matricula,
                        'nome' => $nome
                    ];
                }
            }
        }

        if (!empty($dadosParaInserir)) {
            $funcionarioModel->insertBatch($dadosParaInserir);
            return redirect()->back()->with('success', 'Funcionários importados com sucesso!')
                ->with('funcionariosInseridos', $funcionariosInseridos);
        } else {
            return redirect()->back()->with('error', 'Nenhum dado válido ou novo encontrado no CSV.');
        }
    }
}
