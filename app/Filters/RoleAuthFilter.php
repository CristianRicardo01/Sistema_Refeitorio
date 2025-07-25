<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $isLoggedIn = $session->get('logged_in');
        $userId = $session->get('user_id');

        if (!$isLoggedIn || !$userId) {
            return redirect()->to('/login')->with('error', 'Você precisa estar logado.');
        }

        // Carrega o usuário do banco
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user || (int)$user['ativo'] !== 1) {
            // Encerra a sessão se o usuário estiver bloqueado/inativo
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Sua conta está inativa ou bloqueada.');
        }

        // Mantém atualizado na sessão
        $session->set('user_data', [
            'id'       => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role']
        ]);

        // Se o filtro tiver argumentos, verifica se a role é permitida
        if ($arguments && !in_array($user['role'], $arguments)) {
            return redirect()->back()->with('error', 'Acesso não permitido.');
        }

        return null; // deixa passar
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
