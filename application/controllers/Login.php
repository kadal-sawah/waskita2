<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelLogin');
        
    }


    public function index()
    {
        // echo $this->req->acak('kakatua');
        $this->load->view('Login');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect(base_url('admin'));
        }
        $data = array(
            'script' => 'login',
        );
        $this->load->view('admin/login', $data);
    }

    function aksi()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        $where = array(
            'username' => $user,
            'password' => $this->req->acak($pass)
        );
        if ($this->ModelLogin->cek($where) == true) {
            $userData = $this->ModelLogin->getData();
            if ($userData->status == 1) {
                // $token = $this->req->acak(($this->ModelLogin->token . $user . time()));
                $session = array(
                    'id_user' => $userData->id_user,
                    'nama_user' => $userData->nama_user,
                    'username' => $userData->username,
                    'level' => $userData->level,
                    'akses' => $userData->akses,
                    'akses_kelompok' => $userData->akses_kelompok,
                    'logged_in' => true,
                );
                $this->session->set_userdata($session);
                $pesan = array(
                    'status' => 'ok',
                    'msg' => 'Berhasil Login !'
                );

                // print_r($_SESSION);
                // echo json_encode($pesan);

                redirect(base_url('dashboard'));
            } else {
                $pesan = array(
                    'status' => 'fail',
                    'msg' => 'Akun Anda tidak aktif !'
                );
                // echo json_encode($pesan);
                redirect(base_url('Login'));
            }
        } else {
            $pesan = array(
                'status' => 'fail',
                'msg' => 'Kata Sandi atau Nama Pengguna salah !'
            );
            // echo json_encode($pesan);
            redirect(base_url('Login'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
