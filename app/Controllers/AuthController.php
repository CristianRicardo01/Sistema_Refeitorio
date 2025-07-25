<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (isset($user['ativo']) && !$user['ativo']) {
                return redirect()->back()->withInput()->with('error', 'Sua conta está bloqueada.');
            }

            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'logged_in'  => true,
                    // opcional se quiser guardar role
                    'role'       => $user['role']
                ]);

                return redirect()->to('/admin/dashboard');
            }
        }

        return redirect()->back()->withInput()->with('error', 'Usuário ou senha inválidos.');
    }

    public function logout()
    {
        session()->destroy(); // Destroi a sessão do usuário
        return redirect()->to('/login'); // Redireciona para a tela de login (/login) ou para a rota que vc quiser no caso vou redirecionar para a home ('/').
    }
}
