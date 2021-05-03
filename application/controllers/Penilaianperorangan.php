<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaianperorangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->Import();
    }

    private function Import()
    {
        $this->load->model('ModelPenilaianPerorangan', 'pperorangan');
        $this->load->library('Library');
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('Login'));
        }
    }

    public function Tambah($id = null, $IdAnggota = null)
    {

        try {
            if ($id == null)
                throw new Exception('param kosong');

            // Soal perorangan
            $GetDataCeklis = $this->pperorangan->ReadCeklis();

            $data['Count'] = $GetDataCeklis['count'];
            $data['CollectionsCeklis'] = [];
            if ($GetDataCeklis['count'] > 0)
                $data['CollectionsCeklis'] = $GetDataCeklis['collections']->result_array();

            $GetDataAnggota = $this->pperorangan->ReadAnggota($IdAnggota);
            $data['CountAnggota'] = $GetDataAnggota['count'];
            $data['profil'] = [];
            if ($GetDataAnggota['count'] > 0)
                $data['profil'] = $GetDataAnggota['collections']->result_array()[0];
            // Penilaian Anggota
            $ReadPenilaian = $this->pperorangan->ReadNilaiAnggota($IdAnggota);
            $data['CountPenilaianAnggota'] = $ReadPenilaian['count'];
            $data['NilaiAnggota'] = [];
            if ($data['CountPenilaianAnggota'] > 0)
                $data['NilaiAnggota'] = $ReadPenilaian['collection'];

            // $this->library->printr($data);
            $this->load->view('PenilaianPerorangan/Tambah', $data);
        } catch (Exception $Error) {
        }
    }


    public function StoreTelTelpon()
    {
        $input = $this->input->post();
        $this->library->printr($input);
    }
    
    public function AktivitasDate($kelompok = null)
    {

        try {

            $this->load->model('ModelPenilaianKelompok', 'pkelompok');
            // Read anggota
            $ReadKelompok = $this->pkelompok->ReadKelompok();
            $data['CountKelompok'] = $ReadKelompok['count'];
            $data['CollectionsKelompok'] = [];
            if ($data['CountKelompok'] > 0)
                $data['CollectionsKelompok'] = $ReadKelompok['collections']->result_array();

            // Read jabatan
            if ($kelompok == null) $kelompok = 1;
            $where = null;
            if($this->input->post('tanggal')){
                $tgl = $this->input->post('tanggal');
                $where = $tgl;
            }   
            $tmp = [
                'tanggal' => $where,
                'kelompok' => $kelompok
            ];
            $ReadAnggotaMix = $this->pperorangan->ReadAnggotaMix($tmp);
            $data['count'] = $ReadAnggotaMix['count'];
            $data['collections'] = $ReadAnggotaMix['collections'];
            // $this->library->printr($ReadAnggotaMix);
            $this->load->view('PenilaianPerorangan/DataTanggal', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','" . ($Error->getMessage()) . "')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable " . $Error->getLine() . ($Error->getMessage()) . "')</script>");
            redirect();
        }
    }


    public function index($kelompok = null)
    {

        try {
            $this->load->model('ModelPenilaianKelompok', 'pkelompok');
            // Read anggota
            $ReadKelompok = $this->pkelompok->ReadKelompok();
            $data['CountKelompok'] = $ReadKelompok['count'];
            $data['CollectionsKelompok'] = [];
            if ($data['CountKelompok'] > 0)
                $data['CollectionsKelompok'] = $ReadKelompok['collections']->result_array();

            // Read jabatan
            if ($kelompok == null) $kelompokx['kelompok'] = 1;
            $kelompokx['kelompok'] = $kelompok;
            $kelompokx['tanggal'] =null;
            $ReadAnggotaMix = $this->pperorangan->ReadAnggotaMix($kelompokx);
            $data['count'] = $ReadAnggotaMix['count'];
            $data['collections'] = $ReadAnggotaMix['collections'];
            // $this->library->printr($ReadAnggotaMix);
            $this->load->view('PenilaianPerorangan/Data', $data);
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','" . ($Error->getMessage()) . "')</script>");
            redirect();
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Pesan','Throwable " . $Error->getLine() . ($Error->getMessage()) . "')</script>");
            redirect();
        }
    }

    public function Get($id = null)
    {

        $idKelompok = $id;
        // error_reporting(0);

        try {
            if ($id == null)
                throw new Exception('Kelompok tidak ditemukan');

            $list = $this->pperorangan->get_datatables($id);
            // $this->library->printr($list);
            if ($list['count'] <= 0)
                throw new Exception('Data kosong');

            $data = [];
            foreach ($list['collections'] as $field) {

                $id = sha1($field['id_anggota']);
                $row = array();
                $row[] = $field['nama'];
                $row[] = "{hai ame}";
                $row[] = $field['nrp'];
                $row[] = $field['nama_jabatan'];
                $row[] = empty($field['total_nilai']) ? 0 : $field['total_nilai'];
                $row[] = sha1($field['id_anggota']);
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->pperorangan->count_all($idKelompok),
                "recordsFiltered" => $this->pperorangan->count_filtered($idKelompok),
                "data" => $data,
            );
        } catch (Exception $Error) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
        } catch (Throwable $Error) {
            $output = array(
                "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
            );
        } finally {
            echo json_encode($output);
        }
    }

    public function store()
    {

        try {
            $input = $this->input->post();
            // $this->library->printr($input);
            if (!$input)
                throw new Exception("POST Method");
            $IdSoalPerorangan = array_keys($input['nilai']);
            $data = [
                'id_soal_perorangan' => $IdSoalPerorangan,
                'id_anggota'  => $this->library->XssClean('id_anggota'),
                'id_ceklis'   => $this->library->XssClean('ceklis'),
                'nilai'       => $input['nilai'],
                'id_kelompok'      => $input['id_kelompok'],
            ];

            $Insert = $this->pperorangan->Store($data);
            if ($Insert['status'] != 200)
                throw new Exception($Insert['message']);

            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah ditambahkan')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } finally {
            redirect('penilaianperorangan/tambah/' .  $data['id_kelompok'] . '/' . sha1($data['id_anggota']));
        }
    }

    public function update()
    {
        try {
            $input = $this->input->post();
            // $this->library->printr($input);
            if (!$input)
                throw new Exception("POST Method");
            $IdSoalPerorangan = array_keys($input['nilai']);

            $data = [
                'id_detail_penilaian_perorangan' => $this->input->post('id_detail_penilaian_perorangan'),
                'id_soal_perorangan' => $IdSoalPerorangan,
                'id_anggota'  => $this->library->XssClean('id_anggota'),
                'id_ceklis'   => $this->library->XssClean('ceklis'),
                'nilai'       => $input['nilai'],
                'id_kelompok'      => $input['id_kelompok'],
            ];

            // echo 'penilaianperorangan/tambah/' . sha1($data['id_anggota']) . '/' . $data['id_kelompok'];
            // exit(1);
            // cek 
            // $UpdateOrAdd = $this->pperorangan->UpdateOrAdd($data);

            $Update = $this->pperorangan->StoreUpdate($data);

            if ($Update != true)
                throw new Exception('Sedang terjadi masalah, silahkan coba beberapa saat lagi');

            $this->session->set_flashdata('pesan', "<script>pesan_sukses('Pesan','Data telah update')</script>");
        } catch (Exception $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } catch (Throwable $Error) {
            $this->session->set_flashdata('pesan', "<script>pesan_warning('Kesalahan','" . ($Error->getMessage()) . "')</script>");
        } finally {
            redirect('penilaianperorangan/tambah/' . $data['id_kelompok'] . '/' . sha1($data['id_anggota']));
        }
    }

    public function Ajaxanggota()
    {
        $id = $this->input->get('data');
        $GetAnggota = $this->pperorangan->AjaxAnggota($id);
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

            $GetAnggota = $this->pperorangan->get_datatables($id);

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
                "recordsTotal" => $this->pperorangan->count_all(),
                "recordsFiltered" => $this->pperorangan->count_filtered(),
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


    public function dokumen()
    {
        $input = $this->input->get();
        $ceklis = $input['ceklis'];
        $GetDataSoal = $this->pperorangan->ReadSoal($ceklis);

        $data['count'] = $GetDataSoal['count'];
        $data['collections'] = [];
        if ($GetDataSoal['count'] > 0)
            $data['collections'] = $GetDataSoal['collections']->result_array();

        $GetDataCeklis = $this->pperorangan->ReadCeklis($ceklis);

        if ($GetDataCeklis['count'] > 0) {
            $source = $GetDataCeklis['collections']->row();
            $data['nama_ceklis'] = $source->nama_ceklis;
        }

        $SetData = [
            'id_ceklis'  => $ceklis
        ];

        $CekMode = $this->pperorangan->EditPenilaian($SetData);
        $data['edit'] = [];
        $data['mode'] = $CekMode['edit'];
        if ($CekMode['edit'] == true)
            $data['edit'] = $CekMode['EditData'];
        // $this->library->printr($data);
        echo json_encode($data);
    }
}