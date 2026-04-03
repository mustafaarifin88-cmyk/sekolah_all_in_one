<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url(session()->get('role') . '/dashboard'));
        }
        return view('auth/login');
    }

    public function proses()
    {
        $usersModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $usersModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'id_user'   => $user['id_user'],
                    'username'  => $user['username'],
                    'role'      => $user['role'],
                    'foto'      => $user['foto'],
                    'id_relasi' => $user['id_relasi'],
                    'logged_in' => true
                ];
                session()->set($sessionData);
                return redirect()->to(base_url($user['role'] . '/dashboard'));
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}