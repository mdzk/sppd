<?php

namespace App\Controllers;

use App\Models\Tokens;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function index()
    {

        helper(['form']);
        echo view('login');
    }

    public function auth()
    {
        $session  = session();
        $model    = new UsersModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_users'   => $data['id_users'],
                    'name'      => $data['name'],
                    'role'      => $data['role'],
                    'email'  => $data['email'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Password Salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak Ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerStore()
    {
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => "required|is_unique[users.email]",
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                    'is_unique' => 'Email sudah digunakan, cari yang lain!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib diisi !',
                ]
            ],
        ])) {
            $user = new UsersModel();
            $user->save([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'role' => 'user',
                'foto' => 'default.jpg',
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('pesan', 'Selamat anda berhasil register');
            return redirect()->to('login');
        } else {
            // JIKA TIDAK VALID
            Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to('register');
        }
    }

    public function forgot()
    {
        return view('forgot');
    }

    public function forgotPassword()
    {
        // Logika untuk mengirim email/reset password ke user
        $email = $_POST['email'];
        $userModel = new UsersModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            $token = $this->generateToken();
            $tokenModel = new Tokens();
            $tokenModel->insert([
                'token' => $token,
                'user_id' => $user['id_users'],
                'created' => date('Y-m-d H:i:s')
            ]);

            // Send email with the reset password link
            $resetLink = base_url('reset-password/' . $token); // URL reset password dengan token
            $data = [
                'link' => $resetLink,
            ];
            $message = view('mail/forgot', $data);
            $this->sendEmail($email, 'Reset Password', $message);

            session()->setFlashdata('pesan', 'Berhasil, Silakan cek email anda');
            return redirect()->to('/forgot');
        } else {
            session()->setFlashdata('errors', 'Email tidak ditemukan');
            return redirect()->to('/forgot');
        }
    }

    public function resetPassword($token)
    {
        $tokenModel = new Tokens();
        $tokenData = $tokenModel->where('token', $token)->first();

        if ($tokenData) {
            // Tampilkan halaman form reset password
            return view('reset', ['token' => $token]);
        } else {
            session()->setFlashdata('errors', 'Token salah');
            return redirect()->to('/login');
        }
    }

    public function updatePassword()
    {
        $token = $_POST['token'];
        $password = $_POST['password'];

        $tokenModel = new Tokens();
        $tokenData = $tokenModel->where('token', $token)->first();

        if ($tokenData) {
            if (
                $this->validate([
                    'password'  => [
                        'label'  => 'Password',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => '{field} Wajib diisi !',
                        ]
                    ],
                    'password2' => [
                        'label'  => 'Konfirmasi Password',
                        'rules'  => 'required|matches[password]',
                        'errors' => [
                            'required' =>
                            '{field} Wajib diisi !',
                            'matches'  => '{field} harus sama dengan Password!',
                        ]
                    ],
                ])
            ) {
                $userModel = new UsersModel();
                $userModel->update($tokenData['user_id'], ['password' => password_hash($password, PASSWORD_DEFAULT)]);
                $tokenModel->delete($tokenData['id']);

                session()->setFlashdata('pesan', 'Password Berhasil diubah, silakan masuk');
                return redirect()->to('/login');
            } else { // JIKA TIDAK VALID
                Session()->setFlashdata('errors', \config\Services::validation()->getErrors());
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('errors', 'Token salah');
            return redirect()->to('/reset');
        }
    }

    private function generateToken()
    {
        $length = 32; // Panjang token yang diinginkan
        $token = bin2hex(random_bytes($length / 2));
        return $token;
    }

    private function sendEmail($recipient, $subject, $content)
    {
        $email = \Config\Services::email();
        $email->setTo($recipient);
        $email->setSubject($subject);
        $email->setMessage($content);
        $email->send();
    }
}
