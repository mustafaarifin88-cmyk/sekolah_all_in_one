<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profil extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['profil'] = $model->find(session()->get('id_user'));
        return view('guru/profil', $data);
    }

    public function update()
    {
        $model = new UserModel();
        $id = session()->get('id_user');
        
        $data = ['username' => $this->request->getPost('username')];
        
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $userLama = $model->find($id);
            if ($userLama && $userLama['foto'] && $userLama['foto'] !== 'default.png' && file_exists('uploads/profil/' . $userLama['foto'])) {
                unlink('uploads/profil/' . $userLama['foto']);
            }
            $newName = $foto->getRandomName();
            $foto->move('uploads/profil/', $newName);
            $data['foto'] = $newName;
            session()->set('foto', $newName);
        }
        
        session()->set('username', $data['username']);
        $model->update($id, $data);
        
        return redirect()->to(base_url('guru/profil'))->with('success', 'Profil Anda berhasil diperbarui!');
    }
}