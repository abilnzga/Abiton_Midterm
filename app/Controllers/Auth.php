<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        return $this->login();
    }

    public function login()
    {
        if (session()->get('isLoggedIn') == TRUE) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('pages/commons/login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to(base_url('dashboard'));
        }

        $rules = [
            'inputEmail' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ],
            'inputPassword' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $inputEmail = trim((string) $this->request->getPost('inputEmail'));
        $inputPassword = (string) $this->request->getPost('inputPassword');
        $user = $this->ApplicationModel->getUserByEmail($inputEmail);

        if (! $user || ! password_verify($inputPassword, $user['password'])) {
            session()->setFlashdata('notif_error', 'Invalid email or password.');
            return redirect()->back()->withInput();
        }

        session()->set([
            'user_id'     => $user['userID'],
            'name'        => $user['display_name'],
            'fullname'    => $user['display_name'],
            'email'       => $user['login_email'],
            'username'    => $user['username'],
            'role'        => $user['role'],
            'isLoggedIn'  => true,
        ]);

        session()->setFlashdata('notif_success', 'Login successful. Welcome back.');
        return redirect()->to(base_url('dashboard'));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }

    public function forbiddenPage()
    {
        $data = array_merge($this->data, [
            'title'         => 'Forbidden Page'
        ]);
        return view('pages/commons/forbidden', $data);
    }

    public function register()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('pages/commons/register', [
            'title' => 'Register',
        ]);
    }

    public function storeRegistration()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to(base_url('dashboard'));
        }

        $rules = [
            'inputFullname' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[3]|max_length[255]',
            ],
            'inputEmail' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
            ],
            'inputPassword' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
            ],
            'inputPassword2' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[inputPassword]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $dataUser = [
            'inputFullname' => trim((string) $this->request->getPost('inputFullname')),
            'inputUsername' => trim((string) $this->request->getPost('inputEmail')),
            'inputPassword' => (string) $this->request->getPost('inputPassword'),
            'inputRole'     => 1,
        ];

        $this->ApplicationModel->createUser($dataUser);
        session()->setFlashdata('notif_success', 'Registration successful. You can now log in.');
        return redirect()->to(base_url('login'));
    }
}
