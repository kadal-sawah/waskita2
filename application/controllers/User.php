<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->Import();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('Login'));
        }
    }

    private function Import()
    {
        $this->load->model('ModelUser', 'user');
        $this->load->library('Library');
    }
    public function index()
    {
        $datakelompokna = $this->user->datakelompok();

        $data = array('datakelompokna' => $datakelompokna,);
        $this->load->view('User/Data', $data);
    }

    public function Get()
    {
        error_reporting(0);
        $list = $this->user->get_datatables();
        $no = $_POST['start'];
        $datakelompokna = $this->user->datakelompok();

        $data = [];
        foreach ($list as $field) {

            $id = $this->req->acak($field->id_user);
            $levelna = "";
            $row = array();
            $button = "
                <button class='btn btn-danger btn-sm' id='delete' data-id='$id'><i class='fas fa-trash-alt'></i></button>
                <button class='btn btn-warning btn-sm' id='edit' data-id='$id'><i class='fas fa-pencil-alt'></i></button>
                <button class='btn btn-info btn-sm' id='reset' data-id='$id'><i class='fas fa-sync-alt'></i></button>
                <button class='btn btn-primary btn-sm' id='akses' data-id='$id'><i class='fas fa-edit'></i></button>
            ";
            $row[] = $field->nama_user;
            $row[] = $field->username;
            $row[] = $field->level;
            $row[] = $button;
            $data[] = $row;
            $no++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function getData($id)
    {
        $data = $this->user->get($id);
        foreach ($data as $key => $value) {
            if (strtolower($key) == 'id_user') {
                $data->$key = sha1($value);
            }
        }
        echo json_encode($data);
    }

    public function store()
    {
        $custom = array(
            'password' => $this->req->acak('MURAI'),
        );
        $data = $this->req->all($custom);
        if ($this->user->insert($data) == true) {
            $msg = array(
                'status' => 'ok',
                'msg' => 'Berhasil menambah data !'
            );
            echo json_encode($msg);
        } else {
            $msg = array(
                'status' => 'fail',
                'msg' => 'Gagal menambah data !'
            );
            echo json_encode($msg);
        }
    }

    public function update()
    {
        $id = $this->input->post('id_user');
        $data = $this->req->all(['id_user' => false]);
        if ($this->user->update($data, array('sha1(id_user)' => $id)) == true) {
            $msg = array(
                'status' => 'ok',
                'msg' => 'Berhasil mengubah data !'
            );
        } else {
            $msg = array(
                'status' => 'fail',
                'msg' => 'Gagal mengubah data !'
            );
        }
        echo json_encode($msg);
    }

    public function updatePassword()
    {
        $pass = $this->input->post('password');
        $id = $this->input->post('id_user');
        $custom = array(
            'password' => $this->req->acak($pass),
        );
        $data = $this->req->all($custom);
        if ($this->user->update($data, array('id_user' => $id)) == true) {
            $msg = array(
                'status' => 'ok',
                'msg' => 'Berhasil mengubah data !'
            );
        } else {
            $msg = array(
                'status' => 'fail',
                'msg' => 'Gagal mengubah data !'
            );
        }
        echo json_encode($msg);
    }

    function delete($id)
    {
        if ($this->user->delete($this->req->id('id_user', $id)) == true) {
            $msg = array(
                'status' => 'ok',
                'msg' => 'Berhasil menghapus data !'
            );
        } else {
            $msg = array(
                'status' => 'fail',
                'msg' => 'Gagal menghapus data !'
            );
        }
        echo json_encode($msg);
    }

    function set($id, $action)
    {
        if ($action == 'on') {
            if ($this->user->update(['status' => '1'], $this->req->id($id)) == true) {
                $msg = array(
                    'status' => 'ok',
                    'msg' => 'Berhasil Mengaktifkan Akun !'
                );
            } else {
                $msg = array(
                    'status' => 'fail',
                    'msg' => 'Gagal menambahkan data !'
                );
            }
            echo json_encode($msg);
        } elseif ($action == 'off') {
            if ($this->user->update(['status' => '0'], $this->req->id($id)) == true) {
                $msg = array(
                    'status' => 'ok',
                    'msg' => 'Berhasil Me-nonaktifkan Akun !'
                );
            } else {
                $msg = array(
                    'status' => 'fail',
                    'msg' => 'Gagal Me-nonaktifkan data !'
                );
            }
            echo json_encode($msg);
        } elseif ($action == 'reset') {
            if ($this->user->update(['password' => $this->req->acak('123')], $this->req->id($id)) == true) {
                $msg = array(
                    'status' => 'ok',
                    'msg' => 'Berhasil Me-reset Akun !'
                );
            } else {
                $msg = array(
                    'status' => 'fail',
                    'msg' => 'Gagal Me-reset data !'
                );
            }
            echo json_encode($msg);
        }
    }


    // Pengaturan
    public function pengaturan()
    {
        $this->load->view('User/Pengaturan');
    }
}
