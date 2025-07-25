<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CardapioModel;
use App\Models\CardapioItemModel;

class Cardapio extends BaseController
{
    protected $cardapioModel;
    protected $itemModel;

    public function __construct()
    {
        $this->cardapioModel = new CardapioModel();
        $this->itemModel = new CardapioItemModel();
    }

    public function index()
    {
        $cardapios = $this->cardapioModel->findAll();
        $todosItens = $this->itemModel->findAll();

        $itensPorCardapio = [];
        foreach ($todosItens as $item) {
            $itensPorCardapio[$item['cardapio_id']][] = $item;
        }

        return view('admin/cardapio/index', [
            'cardapios' => $cardapios,
            'itensPorCardapio' => $itensPorCardapio
        ]);
    }

    public function cardapio()
    {
        $cardapios = $this->cardapioModel->findAll();
        $todosItens = $this->itemModel->findAll();

        $itensPorCardapio = [];
        foreach ($todosItens as $item) {
            $itensPorCardapio[$item['cardapio_id']][] = $item;
        }

        return view('public/cardapio/index', [
            'cardapios' => $cardapios,
            'itensPorCardapio' => $itensPorCardapio
        ]);
    }

    public function editAlmoco($id)
    {
        $cardapio = $this->cardapioModel->find($id);
        $itens = $this->itemModel
            ->where('cardapio_id', $id)
            ->where('tipo', 0) // 0 = almoço
            ->findAll();

        return view('admin/cardapio/edit_almoco', compact('cardapio', 'itens'));
    }

    public function editJanta($id)
    {
        $cardapio = $this->cardapioModel->find($id);
        $itens = $this->itemModel
            ->where('cardapio_id', $id)
            ->where('tipo', 1) // 1 = janta
            ->findAll();

        return view('admin/cardapio/edit_janta', compact('cardapio', 'itens'));
    }

    public function updateAlmoco($id)
    {
        $itens = $this->request->getPost('itens');
        $tipo = 0; // almoço

        $this->itemModel->where('cardapio_id', $id)->where('tipo', $tipo)->delete();

        if (!empty($itens)) {
            foreach ($itens as $item) {
                if (!empty(trim($item))) {
                    $this->itemModel->insert([
                        'cardapio_id' => $id,
                        'nome' => $item,
                        'tipo' => $tipo,
                    ]);
                }
            }
        }

        $this->cardapioModel->update($id, ['updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('/admin/cardapio')->with('success', 'Cardápio de almoço atualizado com sucesso.');
    }

    public function updateJanta($id)
    {
        $itens = $this->request->getPost('itens');
        $tipo = 1; // janta

        $this->itemModel->where('cardapio_id', $id)->where('tipo', $tipo)->delete();

        // dd([
        //     'cardapio_id' => $id,
        //     'itens' => $itens,
        //     'tipo' => $tipo
        // ]);

        if (!empty($itens)) {
            foreach ($itens as $item) {
                if (!empty(trim($item))) {
                    $this->itemModel->insert([
                        'cardapio_id' => $id,
                        'nome' => $item,
                        'tipo' => $tipo,
                    ]);
                }
            }
        }

        $this->cardapioModel->update($id, ['updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('/admin/cardapio')->with('success', 'Cardápio de janta atualizado com sucesso.');
    }
}
