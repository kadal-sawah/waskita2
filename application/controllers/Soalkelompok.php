<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soalkelompok extends CI_Controller
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
        $this->load->model('ModelSoalKelompok', 'skelompok');
        $this->load->model('ModelPangkat', 'pangkat');
        $this->load->library('Library');
    }
    public function index($tipeCeklis = null)
    {
        try {

            $ceklis = $tipeCeklis != null ? strtoupper($tipeCeklis) : null;
            $GetData = $this->skelompok->ReadCeklis($ceklis);
            $data['count'] = $GetData['count'];
            $data['collections'] = [];

            if ($data['count'] > 0)
                $data['collections'] = $GetData['collections']->result_array();
            // $this->library->printr($data);
            $this->load->view('SoalKelompok/Data', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','" . ($Error->getMessage()) . "')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable " . ($Error->getMessage()) . "')</script>");
            redirect();
        }
    }

    public function Get($tipeCeklis = null)
    {
        error_reporting(0);
        $ceklis = $tipeCeklis != null ? strtoupper($tipeCeklis) : null;
        $list = $this->skelompok->get_datatables($ceklis);
        // $this->library->printr($list);
        $no = $_POST['start'];

        $data = [];
        $sub = null;
        foreach ($list as $field) {

            $sub = strip_tags($field->tindakan_macam);
            if (strlen($sub) > 60)
                $sub = substr($sub, 0, 60) . '...';
            $id = sha1($field->id_soal_kelompok);
            // $id = ($field->id_soal_kelompok);
            $button = "
                <button class='btn btn-danger btn-sm' id='delete' data-id='$id'><i class='fas fa-trash-alt'></i></button>
                <button class='btn btn-warning btn-sm' id='edit' data-id='$id'><i class='fas fa-pencil-alt'></i></button>
            ";
            $row = array();
            $row[] = $field->id_ceklis;
            $row[] = $field->nama_ceklis;
            // $row[] = $id;
            $row[] = $field->aspek;
            $row[] = $field->maks;
            // $row[] = $sub;
            $row[] = $button;
            $data[] = $row;
            $no++;
        }
        // $this->library->printr($list);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->skelompok->count_all(),
            "recordsFiltered" => $this->skelompok->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function getData($id)
    {
        $data = $this->skelompok->get($id);
        foreach ($data as $key => $value) {
            if (strtolower($key) == 'id_soal_kelompok') {
                $data->$key = sha1($value);
            }
        }
        echo json_encode($data);
    }

    public function store()
    {
        $data = $this->req->all();
        if ($this->skelompok->insert($data) == true) {
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
        $id = $this->input->post('id_soal_kelompok');
        $data = $this->req->all(['id_soal_kelompok' => false]);
        if ($this->skelompok->update($data, array('sha1(id_soal_kelompok)' => $id)) == true) {
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
        if ($this->skelompok->delete(array('sha1(id_soal_kelompok)' => $id)) == true) {
            $msg = array(
                'status' => 'ok',
                'msg' => 'Berhasil menghapus data !'
            );
            echo json_encode($msg);
        } else {
            $msg = array(
                'status' => 'fail',
                'msg' => 'Gagal menghapus data !'

            );
            echo $uwu = $this->db->last_query();
            echo json_encode($msg);
        }
    }
}
