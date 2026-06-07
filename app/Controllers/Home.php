<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Landing Page',
            'page' => 'control-panel/landing_page',

        ];
        return view('control-panel/landing_page', $data);
    }

    public function login()
    {
        $data = [
            'judul' => 'Login',
            'page' => 'auth/v_login',

        ];
        return view('auth/v_login', $data);
    }


    public function register()
    {
        $data = [
            'judul' => 'Register',
            'page' => 'auth/v_register',

        ];
        return view('auth/v_register', $data);
    }

    public function forget_password()
    {
        $data = [
            'judul' => 'Forgot Password',
            'page' => 'awth/v_forget_password',

        ];
        return view('auth/v_forget_password', $data);
    }

    public function dashboard()
    {
        $data = [
            'judul' => 'Dashboard',
            'page' => 'control-panel/v_dashboard',

        ];
        return view('control-panel/v_dashboard', $data);
    }
}
