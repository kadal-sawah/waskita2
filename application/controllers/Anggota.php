<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->Import();
        //cek login
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('Login'));
        }
    }

    private function Import()
    {
        $this->load->model('ModelAnggota', 'anggota');
        $this->load->library('Library');
    }
    public function index()
    {
        try {

            $reference = array(
                'pangkat' => $this->anggota->ReadPangkat(),
                'kelompok' => $this->anggota->ReadKelompok(),
                'jabatan' => $this->anggota->ReadJabatan(),
            );
            $data = array(
                'menu'  => 'master',
                'sub'  => 'anggota',
                'ref' => $reference
            );
            $this->load->view('Anggota/Data', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','" . ($Error->getMessage()) . "')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable " . ($Error->getMessage()) . "')</script>");
            redirect();
        }
    }

    public function Get()
    {
        error_reporting(0);
        $list = $this->anggota->get_datatables();
        $no = $_POST['start'];

        $data = [];
        foreach ($list as $field) {
            $IdAnggota = $this->req->acak($field->id_anggota);
            $row = array();
            $button = "
            <button class='btn btn-danger btn-sm' id='delete' data-id='$IdAnggota'><i class='fas fa-trash-alt'></i></button>
            <button class='btn btn-warning btn-sm' id='edit' data-id='$IdAnggota'><i class='fas fa-pencil-alt'></i></button>
            ";
            $row[] = $field->nrp;
            $row[] = $field->nama;
            $row[] = $field->nama_pangkat;
            $row[] = $field->nama_jabatan;
            $row[] = $button;
            $data[] = $row;
            $no++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->anggota->count_all(),
            "recordsFiltered" => $this->anggota->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }



    function getData($id)
    {
        $data = $this->anggota->get($id);
        foreach ($data as $key => $value) {
            if (strtolower($key) == 'id_anggota') {
                $data->$key = sha1($value);
            }
        }
        echo json_encode($data);
    }

    public function store()
    {
        $data = $this->req->all();
        if ($this->anggota->insert($data) == true) {
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
        $id = $this->input->post('id_anggota');
        $data = $this->req->all(['id_anggota' => false]);
        if ($this->anggota->update($data, array('sha1(id_anggota)' => $id)) == true) {
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

    public function delete($id)
    {
        if ($this->anggota->delete($this->req->id('id_anggota', $id)) == true) {
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
            if ($this->anggota->update(['status' => '1'], $this->req->id($id)) == true) {
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
            if ($this->anggota->update(['status' => '0'], $this->req->id($id)) == true) {
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
            if ($this->anggota->update(['password' => $this->req->acak('123')], $this->req->id('id_anggota', $id)) == true) {
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
}
