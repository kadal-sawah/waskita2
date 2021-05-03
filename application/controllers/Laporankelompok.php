<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporankelompok extends CI_Controller
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
        $this->load->model('ModelPenilaianKelompok', 'pkelompok');
        $this->load->library('Library');
    }

    public function Tambah($id = null)
    {
        try {
            if ($id == null)
                throw new Exception('param kosong');

            // info ReadKelompokInfo
            $GetInfoKelompok = $this->pkelompok->ReadKelompokInfo($id);
            $data['CountInfoKelompok'] = $GetInfoKelompok['count'];
            if ($data['CountInfoKelompok'] <= 0)
                throw new Exception("Info kelompok tidak ditemukan");

            $data['profil'] = [];
            if ($GetInfoKelompok['count'] > 0)
                $data['profil'] = $GetInfoKelompok['collections']->result_array()[0];

            $data['TotalNilai'] = $this->pkelompok->TotalNilai($id);
            // $this->library->printr($data);
            $this->load->view('PenilaianKelompok/Tambah', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','" . ($Error->getMessage()) . "')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_error('Pesan','Throwable " . ($Error->getMessage()) . "')</script>");
            redirect();
        }
    }
    public function index()
    {

        try {

            // Read anggota
            $ReadKelompok = $this->pkelompok->ReadKelompok();
            $data['CountKelompok'] = $ReadKelompok['count'];
            $data['CollectionsKelompok'] = [];

            if ($data['CountKelompok'] > 0)
                $data['CollectionsKelompok'] = $ReadKelompok['collections']->result_array();

            // $this->library->printr($GetDataPenilaian['collections']->result_array());
            $this->load->view('LaporanKelompok/Data', $data);
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
        $list = $this->pkelompok->get_datatables($ceklis);
        if ($list['count'] <= 0)
            throw new Exception('Data kosong');

        $no = $_POST['start'];

        $data = [];
        $sub = null;
        foreach ($list['collections'] as $field) {

            $id = sha1($field['id_kelompok']);
            $row = array();
            $row[] = $field['nama_kelompok'];
            $row[] = $field['jumlah_anggota'] . ' Anggota';

            $row[] = "<a href='" . base_url('laporanperorangan/' . $id) . "'
                        class='btn btn-dark px-2 montserrat-600 letter-spacing py-1'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24'
                        stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                        <path stroke='none' d='M0 0h24v24H0z' />
                        <polyline points='9 11 12 14 20 6' />
                        <path d='M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9' /></svg>
                        Lihat Nilai
                    </a>";
            $data[] = $row;
            $no++;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pkelompok->count_all(),
            "recordsFiltered" => $this->pkelompok->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function store()
    {
        try {
            $input = $this->input->post();
            // $this->library->printr($input);
            if (!$input)
                throw new Exception("POST Method");
            $IdSoalKelompok = $input['id_soal_kelompok'];
            $data = [
                'id_soal_kelompok' => $IdSoalKelompok,
                'id_kelompok'  => $this->library->XssClean('id_kelompok'),
                'id_ceklis'   => $this->library->XssClean('ceklis'),
                'nilai'       => $input['nilai'],
                'ket'         => $input['ket']
            ];
            // $this->library->printr($data);
            // cek 
            // $UpdateOrAdd = $this->pkelompok->UpdateOrAdd($data);

            $Insert = $this->pkelompok->Store($data);
            if ($Insert['status'] != 200)
                throw new Exception($Insert['message']);

            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah ditambahkan')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } finally {
            redirect('penilaiankelompok/tambah/' . sha1($data['id_kelompok']));
        }
    }

    public function update()
    {
        try {
            $input = $this->input->post();
            $this->library->printr($input);
            if (!$input)
                throw new Exception("POST Method");
            $IdSoalPerorangan = array_keys($input['yes_no']);
            $data = [
                'id_detail_penilaian_perorangan' => $this->input->post('id_detail_penilaian_perorangan'),
                'id_soal_perorangan' => $IdSoalPerorangan,
                'id_anggota'  => $this->library->XssClean('id_anggota'),
                'id_ceklis'   => $this->library->XssClean('ceklis'),
                'nilai'       => $input['nilai'],
                'yes_no'      => $input['yes_no'],
            ];


            // cek 
            // $UpdateOrAdd = $this->pkelompok->UpdateOrAdd($data);

            $Update = $this->pkelompok->StoreUpdate($data);
            if ($Update != true)
                throw new Exception('Sedang terjadi masalah, silahkan coba beberapa saat lagi');

            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah update')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } finally {
            redirect('penilaianperorangan');
        }
    }

    public function Ajaxanggota()
    {
        $id = $this->input->get('data');
        $GetAnggota = $this->pkelompok->AjaxAnggota($id);
        $data['count'] = 0;
        if ($GetAnggota->num_rows() > 0) {
            $source = $GetAnggota->row();
            $data['nrp'] = $source->nrp;
            $data['id_anggota'] = $source->id_anggota;
            $data['nama_pangkat'] = $source->nama_pangkat;
            $data['count'] = $GetAnggota->num_rows();
        }
        echo json_encode($data);
    }

    public function Ajaxkelompok($id = null)
    {
        error_reporting(0);

        try {

            $GetAnggota = $this->pkelompok->get_datatables($id);

            if ($GetAnggota['count'] <= 0)
                throw new Exception('Data kosong');

            foreach ($GetAnggota['collections'] as $field) {

                $id = sha1($field['id_anggota']);
                $row = array();

                $row[] = $field['nama'];
                $row[] = $field['nama_pangkat'];
                $row[] = $field['nrp'];
                $row[] = $field['nama_kelompok'];

                $row[] = "<a href='" . base_url('penilaianperorangan/tambah/' . $id) . "'
                                class='btn btn-primary px-2 montserrat-600 letter-spacing py-1'>
                                <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24'
                                stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                <path stroke='none' d='M0 0h24v24H0z' />
                                <polyline points='9 11 12 14 20 6' />
                                <path d='M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9' /></svg>
                                Beri nilai
                            </a>";
                $data[] = $row;
            }
            $message = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->pkelompok->count_all(),
                "recordsFiltered" => $this->pkelompok->count_filtered(),
                "data" => $data,
            );
            echo json_encode($message);
        } catch (Exception $Error) {
            $message = array(
                "draw" => '1',
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array(),
            );
            echo json_encode($message);
        } catch (Throwable $Error) {
            $message = array(
                "draw" => '1',
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array(),
            );
            echo json_encode($message);
        }
    }


    public function dokumen($IdKelompok)
    {
        $input = $this->input->get();
        $ceklis = $input['ceklis'];
        $GetDataSoal = $this->pkelompok->ReadSoal($ceklis);
        $data['CountSoal'] = $GetDataSoal['count'];
        $data['CollectionsSoal'] = 0;
        $data['mode'] = false;
        $data['edit'] = [];

        if ($data['CountSoal'] > 0) {
            $data['CollectionsSoal'] = $GetDataSoal['collections']->result_array();
            $data['nama_ceklis'] = $GetDataSoal['nama_ceklis'];

            // mode edit
            $SetData = [
                'id_ceklis' => $ceklis,
                'id_kelompok' => $IdKelompok
            ];
            $CekMode = $this->pkelompok->EditPenilaian($SetData);
            $data['mode'] = $CekMode['edit'];
            $data['edit'] = $CekMode['EditData'];
        }
        echo json_encode($data);
    }

    public function ajaxtipe()
    {
        $data = $this->input->get('data');

        $Ceklis = $this->db->get_where('ceklis', ['tipe' => $data]);

        $SetData['collections'] = [];
        $SetData['count'] = 0;
        if ($Ceklis->num_rows() > 0) {
            $source = $Ceklis->result_array();
            $SetData['collections'] = $source;
            $SetData['count'] = $Ceklis->num_rows();
        }
        echo json_encode($SetData);
    }

    public function ajaxtel()
    {
        $data = $this->input->get('data');

        $Ceklis = $this->db->get_where('ceklis', ['tipe' => $data]);

        $SetData['collections'] = [];
        $SetData['count'] = 0;
        if ($Ceklis->num_rows() > 0) {
            $source = $Ceklis->result_array();
            $SetData['collections'] = $source;
            $SetData['count'] = $Ceklis->num_rows();
        }
        echo json_encode($SetData);
    }
}
