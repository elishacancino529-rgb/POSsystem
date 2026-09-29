<?php

namespace App\Controllers;

use App\Models\UserModel;

// Users controller handles the User Accounts page (/users).
class Users extends BaseController
{
    public function index()
    {
        // Retrieve all user records from the database through the Model.
        $model = new UserModel();
        $users = $model->findAll();

        // Pass the records to the view as 'users' so the view can loop over them.
        return view('users', ['users' => $users]);
    }

    public function new()
    {
        return view('user_form', ['user' => null, 'formTitle' => 'New user', 'formAction' => site_url('users')]);
    }

    public function create()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[2]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert([
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ]);

        return redirect()->to(site_url('users'))->with('message', 'User account created.');
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->find($id);
        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('user_form', ['user' => $user, 'formTitle' => 'Edit user', 'formAction' => site_url('users/update/' . $id)]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,' . $id . ']',
            'full_name' => 'required|min_length[2]',
            'avatar'   => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $uploads = FCPATH . 'uploads';
            if (! is_dir($uploads)) {
                mkdir($uploads, 0755, true);
            }

            $filename = bin2hex(random_bytes(16)) . '.jpg';
            \Config\Services::image()
                ->withFile($file->getTempName())
                ->fit(256, 256, 'top')
                ->save($uploads . DIRECTORY_SEPARATOR . $filename, 85);

            if (! empty($user['avatar']) && is_file($uploads . DIRECTORY_SEPARATOR . $user['avatar'])) {
                unlink($uploads . DIRECTORY_SEPARATOR . $user['avatar']);
            }
            $data['avatar'] = $filename;
        }

        $model->update($id, $data);

        return redirect()->to(site_url('users'))->with('message', 'User account updated.');
    }
}
