<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(app_base_url() . '/');
        }

        return view('login');
    }

    public function attempt()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = (new UserModel())->where('username', $username)->first();

        if (! $user || empty($user['password']) || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('errors', ['credentials' => 'The username or password is incorrect.']);
        }

        session()->regenerate(true);
        session()->set([
            'user_id'     => $user['id'],
            'username'    => $user['username'],
            'full_name'   => $user['full_name'],
            'isLoggedIn'  => true,
        ]);

        return redirect()->to(app_base_url() . '/')->with('message', 'Welcome back, ' . $user['full_name'] . '.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(app_base_url() . '/login')->with('message', 'You have been logged out.');
    }
}
