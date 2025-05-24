<?php

namespace App\Controller;

use App\Model\User;
session_start();

include_once __DIR__ . '/../model/User.php';


class UsersController
{

    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function authRegister($data)
    {
        $checkUser = $this->model->all()->where('name', ' = ', $data['name'])->count();
        if ($checkUser > 0) {
            return ['success' => false, 'message' => 'Username sudah ada'];
        }
        $checkEmail = $this->model->all()->where('email', ' = ', $data['email'])->count();
        if ($checkEmail > 0) {
            return ['success' => false, 'message' => 'Email sudah ada'];
        }

        if ($data['password'] !== $data['konfirmasi']) {
            return ['success' => false, 'message' => 'Password dan Konfirmasi tidak sama'];
        }

        $this->model->create([
            'name' => $data['name'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'email' => $data['email'],
        ]);

        return ['success' => true, 'message' => 'Berhasil membuat akun!'];
    }

    public function authLogin($data)
    {
        $checkData = $this->model->all()->where('email', ' = ', $data['email'])->get();
        $user = isset($checkData[0]) ? $checkData[0] : null;
        if ($user > 0 && password_verify($data['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            return ['success' => true, 'message' => 'Login berhasil'];
        }

        return ['success' => true, 'message' => 'Email atau Passwordmu Salah !'];
    }

    public function getAuth()
    {
        return $_SESSION['user'];
    }

    public function authLogout()
    {
        session_unset();
        session_destroy();
        return ['success' => true, 'message' => 'Selamat Tinggal!'];
    }
}
